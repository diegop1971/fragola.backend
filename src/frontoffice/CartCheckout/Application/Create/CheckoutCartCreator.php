<?php

declare(strict_types=1);

namespace src\frontoffice\CartCheckout\Application\Create;

use Throwable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use src\frontoffice\Orders\Domain\Order;
use src\frontoffice\Orders\Domain\ValueObjects\OrderId;
use src\frontoffice\orders\Domain\ValueObjects\OrderCustomerId;
use src\frontoffice\Orders\Domain\Interfaces\IOrderRepository;
use src\frontoffice\Orders\Domain\ValueObjects\OrderTotalPaid;
use src\frontoffice\Orders\Domain\ValueObjects\OrderItemsQuantity;
use src\frontoffice\OrdersDetails\Domain\ValueObjects\OrderDetail;
use src\frontoffice\CartCheckout\Domain\PaymentProcessingException;
use src\frontoffice\Orders\Domain\ValueObjects\OrderPaymentMethodId;
use src\frontoffice\OrderStatus\Domain\Interfaces\IOrderStatusRepository;
use src\frontoffice\CartCheckout\Domain\Services\PaymentGatewayFactoryService;
use src\frontoffice\Orders\Domain\ValueObjects\OrderStatusId;
use src\frontoffice\PaymentMethods\Domain\Interfaces\IPaymentMethodsRepository;

final class CheckoutCartCreator
{
    private $orderRepository;
    private $paymentGateway;

    public function __construct(IOrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function __invoke(
        OrderId $orderId,
        OrderCustomerId $customerId,
        OrderPaymentMethodId $paymentMethodId,
        OrderItemsQuantity $itemsQuantity,
        OrderTotalPaid $totalPaid,
        OrderDetail $orderDetail,
        IOrderStatusRepository $orderStatusRepository,
        IPaymentMethodsRepository $paymentMethodsRepository,
    ) {
        try {
            DB::beginTransaction();
            $paymentMethod = $paymentMethodsRepository->searchWithInitialOrderStatusName($paymentMethodId);
            $paymentMethodName = $paymentMethod['short_name'];
            
            $paymentGateway = PaymentGatewayFactoryService::createPaymentGateway($paymentMethodName, $orderStatusRepository);
            
            // por ahora las clases encargadas de cada tipo de pago solo devuelven success => true, y el nombre de la clase, luego irá la lógica correspondiente
            $paymentGatewayResponse = $paymentGateway->processPayment(100);           
            
            $orderStatusId = new OrderStatusId($paymentMethod['initial_order_status_id']);
            
            $order = Order::create(
                $orderId,
                $customerId,
                $paymentMethodId,
                $orderStatusId,
                $itemsQuantity,
                $totalPaid,
            );
            
            $this->orderRepository->save($order);
            
            DB::commit();
        } catch (Throwable $e) {
            DB::rollback();
            throw $e;
        }
    }
}


