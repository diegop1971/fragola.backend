<?php

declare(strict_types=1);

namespace src\frontoffice\CartCheckout\Application\Create;

use Throwable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use src\frontoffice\Orders\Domain\Order;
use src\frontoffice\Orders\Domain\ValueObjects\OrderId;
use src\frontoffice\OrdersDetails\Domain\OrderDetailEntity;
use src\frontoffice\Orders\Domain\ValueObjects\OrderStatusId;
use src\frontoffice\Orders\Domain\Interfaces\IOrderRepository;
use src\frontoffice\Orders\Domain\ValueObjects\OrderTotalPaid;
use src\frontoffice\orders\Domain\ValueObjects\OrderCustomerId;
use src\frontoffice\Customers\Domain\ValueObjects\CustomerEmail;
use src\frontoffice\CartCheckout\Domain\ValueObjects\OrderDetail;
use src\frontoffice\Orders\Domain\ValueObjects\OrderItemsQuantity;
use src\frontoffice\CartCheckout\Domain\PaymentProcessingException;
use src\frontoffice\Customers\Domain\ValueObjects\CustomerLastName;
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

final class CheckoutCartCreator
{
    private $orderRepository;
    private $orderDetailRepository;
    private $customerHandlerService;
    private $paymentGateway;
    private $orderId;
    private $deleteCartService;

    public function __construct(
        IOrderRepository $orderRepository,
        IOrderDetailRepository $orderDetailRepository,
        ICustomerHandlerService $customerHandlerService,
        IDeleteCartService $deleteCartService,
    ) {
        $this->orderRepository = $orderRepository;
        $this->orderDetailRepository = $orderDetailRepository;
        $this->customerHandlerService = $customerHandlerService;
        $this->deleteCartService = $deleteCartService;
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
                $orderDetail = OrderDetailEntity::create(
                    OrderDetailId::random(),
                    $orderId,
                    new OrderDetailProductId($detail['productId']),
                    new OrderDetailQuantity($detail['productQty']),
                    new OrderDetailUnitPrice($detail['productUnitPrice']),
                );
                $this->orderDetailRepository->insert($orderDetail);
            }, $orderDetails->value());
            DB::commit();
            $this->deleteCartService->deleteCart();
        } catch (Throwable $e) {
            DB::rollback();
            throw $e;
        }
    }
}
