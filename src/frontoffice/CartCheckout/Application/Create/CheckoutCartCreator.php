<?php

declare(strict_types=1);

namespace src\frontoffice\CartCheckout\Application\Create;

use Throwable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use src\frontoffice\Orders\Domain\Order;
use src\frontoffice\Orders\Domain\ValueObjects\OrderId;
use src\frontoffice\Orders\Domain\ValueObjects\OrderStatusId;
use src\frontoffice\Orders\Domain\Interfaces\IOrderRepository;
use src\frontoffice\Orders\Domain\ValueObjects\OrderTotalPaid;
use src\frontoffice\orders\Domain\ValueObjects\OrderCustomerId;
use src\frontoffice\Orders\Domain\ValueObjects\OrderItemsQuantity;
use src\frontoffice\OrdersDetails\Domain\ValueObjects\OrderDetail;
use src\frontoffice\CartCheckout\Domain\PaymentProcessingException;
use src\frontoffice\Orders\Domain\ValueObjects\OrderPaymentMethodId;
use src\frontoffice\OrdersDetails\Domain\ValueObjects\OrderDetailId;
use src\frontoffice\OrderStatus\Domain\Interfaces\IOrderStatusRepository;
use src\frontoffice\CartCheckout\Domain\Services\PaymentGatewayFactoryService;
use src\frontoffice\PaymentMethods\Domain\Interfaces\IPaymentMethodsRepository;
use src\frontoffice\OrdersDetails\Infrastructure\Persistence\Eloquent\OrderDetailEloquentModel;

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
        OrderDetail $orderDetails,
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

            //Importante, desacoplar el model de la capa Application, debe interactuar a través de un repositorio!!!!
            $orderDetails->value();

            $dataToInsert = array_map(function ($detail) use ($orderId) {
                return [
                    'id' => OrderDetailId::random()->value(),
                    'order_id' => $orderId->value(),
                    'product_id' => $detail['productId'],
                    'quantity' => $detail['productQty'],
                    'unit_price' => $detail['productUnitPrice'],
                ];
            }, $orderDetails->value());

            //Log::info($dataToInsert);
            OrderDetailEloquentModel::insert($dataToInsert);


            DB::commit();
        } catch (Throwable $e) {
            DB::rollback();
            throw $e;
        }
    }
}
