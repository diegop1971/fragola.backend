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
use src\frontoffice\Customers\Domain\Interfaces\ICustomerRepository;
use src\frontoffice\Customers\Domain\ValueObjects\CustomerFirstName;
use src\frontoffice\Orders\Domain\ValueObjects\OrderPaymentMethodId;
use src\frontoffice\OrdersDetails\Domain\ValueObjects\OrderDetailId;
use src\frontoffice\OrderStatus\Domain\Interfaces\IOrderStatusRepository;
use src\frontoffice\OrdersDetails\Domain\ValueObjects\OrderDetailQuantity;
use src\frontoffice\OrdersDetails\Domain\Interfaces\IOrderDetailRepository;
use src\frontoffice\OrdersDetails\Domain\ValueObjects\OrderDetailProductId;
use src\frontoffice\OrdersDetails\Domain\ValueObjects\OrderDetailUnitPrice;
use src\frontoffice\CartCheckout\Domain\Services\PaymentGatewayFactoryService;
use src\frontoffice\PaymentMethods\Domain\Interfaces\IPaymentMethodsRepository;
use src\frontoffice\OrdersDetails\Infrastructure\Persistence\Eloquent\OrderDetailEloquentModel;

final class CheckoutCartCreator
{
    private $orderRepository;
    private $orderDetailRepository;
    private $customerRespository;
    private $paymentGateway;
    private $orderId;

    public function __construct(IOrderRepository $orderRepository, IOrderDetailRepository $orderDetailRepository, ICustomerRepository $customerRespository)
    {
        $this->orderRepository = $orderRepository;
        $this->orderDetailRepository = $orderDetailRepository;
        $this->customerRespository = $customerRespository;
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

            /*$customer = $this->customerRespository->searchByEmail($customerEmail->value());

            if ($customer === null) {
                // llama a un servicio de dominio que crea un nuevo customer y devuelve el id del nuevo customer
            }

            $customerId = new OrderCustomerId($customer['id']);*/

            $this->orderId = $orderId;

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
        } catch (Throwable $e) {
            DB::rollback();
            throw $e;
        }
    }
}
/**
 * el customer está logueado => existe en la db
 * tenemos customerId
 * se asigna customerId a la order
 * la order es de tipo cliente
 * 
 * el customer es cliente pero compra como invitado => existe en la db
 * no tenemos customerId
 * existe customerEmail
 * a partir de customerEmail se recupera customerID de la bd
 * se le asigna customerId a la order
 * la order es de tipo invitado
 * 
 * el customer no es cliente pero ya compró como invitadoy => existe en la db
 * no tenemos customerId
 * 
 * si el customer no es cliente y es su primera compra como invitado => no existe en la db
 * no tenemos customerId
 * existe customerEmail que se provee en el checkout
 * se verifica mediante el customerEmail que la no existencia en la bd
 * no existe customerId
 * se da de alta como cliente de tipo invitado
 * se asigna customerId a la order
 * la order es de tipo invitado
 */
