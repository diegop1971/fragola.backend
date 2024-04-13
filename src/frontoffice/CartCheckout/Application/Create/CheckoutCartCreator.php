<?php

declare(strict_types=1);

namespace src\frontoffice\CartCheckout\Application\Create;

use Throwable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use src\backoffice\StockMovements\Domain\ValueObjects\StockProductId as ValueObjectsStockProductId;
use src\backoffice\StockMovementType\Domain\StockMovementType;
use src\frontoffice\Orders\Domain\Order;
use src\frontoffice\Orders\Domain\ValueObjects\OrderId;
use src\frontoffice\StockMovements\Domain\StockMovement;
use src\frontoffice\OrdersDetails\Domain\OrderDetailEntity;
use src\frontoffice\Orders\Domain\ValueObjects\OrderStatusId;
use src\frontoffice\Orders\Domain\Interfaces\IOrderRepository;
use src\frontoffice\Orders\Domain\ValueObjects\OrderTotalPaid;
use src\frontoffice\orders\Domain\ValueObjects\OrderCustomerId;
use src\frontoffice\StockMovements\Domain\ValueObjects\StockId;
use src\frontoffice\Customers\Domain\ValueObjects\CustomerEmail;
use src\frontoffice\CartCheckout\Domain\ValueObjects\OrderDetail;
use src\frontoffice\Orders\Domain\ValueObjects\OrderItemsQuantity;
use src\frontoffice\CartCheckout\Domain\PaymentProcessingException;
use src\frontoffice\CartCheckout\Domain\ValueObjects\StockQuantity;
use src\frontoffice\Customers\Domain\ValueObjects\CustomerLastName;
use src\frontoffice\CartCheckout\Domain\ValueObjects\StockProductId;
use src\frontoffice\Customers\Domain\ValueObjects\CustomerFirstName;
use src\frontoffice\Orders\Domain\ValueObjects\OrderPaymentMethodId;
use src\frontoffice\OrdersDetails\Domain\ValueObjects\OrderDetailId;
use src\frontoffice\CartCheckout\Domain\Interfaces\IDeleteCartService;
use src\frontoffice\Customers\Domain\Interfaces\ICustomerHandlerService;
use src\frontoffice\Customers\Domain\ValueObjects\CustomerRememberToken;
use src\frontoffice\OrderStatus\Domain\Interfaces\IOrderStatusRepository;
use src\frontoffice\Customers\Domain\ValueObjects\CustomerEmailVerifiedAt;
use src\frontoffice\OrdersDetails\Domain\ValueObjects\OrderDetailQuantity;
use src\frontoffice\OrdersDetails\Domain\Interfaces\IOrderDetailRepository;
use src\frontoffice\OrdersDetails\Domain\ValueObjects\OrderDetailProductId;
use src\frontoffice\OrdersDetails\Domain\ValueObjects\OrderDetailUnitPrice;
use src\frontoffice\CartCheckout\Domain\Services\PaymentGatewayFactoryService;
use src\frontoffice\PaymentMethods\Domain\Interfaces\IPaymentMethodsRepository;
use src\frontoffice\StockMovements\Domain\Interfaces\IStockAvailabilityService;
use src\frontoffice\StockMovements\Domain\Interfaces\IStockMovementRepository;
use src\frontoffice\StockMovements\Domain\ValueObjects\StockDate;
use src\frontoffice\StockMovements\Domain\ValueObjects\StockEnabled;
use src\frontoffice\StockMovements\Domain\ValueObjects\StockMovementTypeId;
use src\frontoffice\StockMovements\Domain\ValueObjects\StockNotes;
use src\frontoffice\StockMovements\Domain\ValueObjects\StockProductId as DomainValueObjectsStockProductId;
use src\frontoffice\StockMovements\Domain\ValueObjects\StockQuantity as ValueObjectsStockQuantity;
use src\frontoffice\StockMovementType\Domain\IStockMovementTypeRepository;

final class CheckoutCartCreator
{
    private $orderRepository;
    private $orderDetailRepository;
    private $stockMovementRepository;
    private $customerHandlerService;
    private $paymentGateway;
    private $orderId;
    private $deleteCartService;
    private $stockAvailabilityService;
    private $stockMovementTypeRepository;
    private $stockMovementTypeId;

    public function __construct(
        IOrderRepository $orderRepository,
        IOrderDetailRepository $orderDetailRepository,
        IStockMovementRepository $stockMovementRepository,
        ICustomerHandlerService $customerHandlerService,
        IDeleteCartService $deleteCartService,
        IStockAvailabilityService $stockAvailabilityService,
        IStockMovementTypeRepository $stockMovementTypeRepository,

    ) {
        $this->orderRepository = $orderRepository;
        $this->orderDetailRepository = $orderDetailRepository;
        $this->stockMovementRepository = $stockMovementRepository;
        $this->customerHandlerService = $customerHandlerService;
        $this->deleteCartService = $deleteCartService;
        $this->stockAvailabilityService = $stockAvailabilityService;
        $this->stockMovementTypeRepository = $stockMovementTypeRepository;
    }

    public function __invoke(
        OrderId $orderId,
        OrderCustomerId $customerId,
        CustomerEmail $customerEmail,
        CustomerFirstName $customerFirstName,
        CustomerLastName $customerLastName,
        OrderPaymentMethodId $paymentMethodId,
        OrderItemsQuantity $itemsQuantity,
        OrderTotalPaid $totalPaid,
        OrderDetail $orderDetails,
        IOrderStatusRepository $orderStatusRepository,
        IPaymentMethodsRepository $paymentMethodsRepository,
    ) {
        try {
            DB::beginTransaction();

            $customerEmailVerifiedAt = new CustomerEmailVerifiedAt(null);

            $customerRememberToken = new CustomerRememberToken(null);

            $customerId = $this->customerHandlerService->handler($customerFirstName, $customerLastName, $customerEmail, $customerEmailVerifiedAt, $customerRememberToken);

            $orderCustomerId = new OrderCustomerId($customerId->value());

            $this->orderId = $orderId;

            $paymentMethod = $paymentMethodsRepository->searchWithInitialOrderStatusName($paymentMethodId);
            $paymentMethodName = $paymentMethod['short_name'];

            $this->stockMovementTypeId = $this->stockMovementTypeRepository->searchByShortName('exit_by_sale');

            $paymentGateway = PaymentGatewayFactoryService::createPaymentGateway($paymentMethodName, $orderStatusRepository);

            // por ahora las clases encargadas de cada tipo de pago solo devuelven success => true, y el nombre de la clase, luego irá la lógica correspondiente
            $paymentGatewayResponse = $paymentGateway->processPayment(100);

            $orderStatusId = new OrderStatusId($paymentMethod['initial_order_status_id']);

            $order = Order::create(
                $orderId,
                $orderCustomerId,
                $paymentMethodId,
                $orderStatusId,
                $itemsQuantity,
                $totalPaid,
            );

            $this->orderRepository->save($order);

            array_map(function ($detail) use ($orderId) {

                $this->validateOperation(new DomainValueObjectsStockProductId($detail['productId']), new ValueObjectsStockQuantity($detail['productQty']));
                
                $orderDetail = OrderDetailEntity::create(
                    OrderDetailId::random(),
                    $orderId,
                    new OrderDetailProductId($detail['productId']),
                    new OrderDetailQuantity($detail['productQty']),
                    new OrderDetailUnitPrice($detail['productUnitPrice']),
                );
                $this->orderDetailRepository->insert($orderDetail);

                $stockMovement = StockMovement::create(
                    StockId::random(),
                    new DomainValueObjectsStockProductId($detail['productId']),
                    new StockMovementTypeId($this->stockMovementTypeId),
                    
                    // usar servicio stockQuantitySignHandlerService!!!
                    new ValueObjectsStockQuantity($detail['productQty'] * -1),
                    new StockDate(date('Y-m-d H:i:s')),
                    new StockNotes(''),
                    new StockEnabled(true),
                );
                $this->stockMovementRepository->insert($stockMovement);
            }, $orderDetails->value());
            DB::commit();
            $this->deleteCartService->deleteCart();
        } catch (Throwable $e) {
            DB::rollback();
            throw $e;
        }
    }

    private function validateOperation($stockProductId, $stockQuantity): void
    {
        $this->stockAvailabilityService->makeStockOut($stockProductId, $stockQuantity);

        /*$this->stockValidateQuantityGreaterThanZeroService->validateQuantityGreaterThanZero($stockQuantity);

        $stockMovementType = $this->stockMovementTypeCheckerService->stockMovementType($this->stockMovementTypeRepository, $stockMovementTypeId);

        $stockQuantitySigned = $this->stockQuantitySignHandlerService->setStockQuantitySign($stockMovementType, $stockQuantity);

        return $stockQuantitySigned;*/
    }
}
