<?php

declare(strict_types=1);

namespace src\frontoffice\CartCheckout\Application\Create;

use Throwable;
use Illuminate\Support\Facades\Log;
use src\frontoffice\CartCheckout\Domain\ValueObjects\OrderId;
use src\frontoffice\Customers\Domain\ValueObjects\CustomerId;
use src\frontoffice\Orders\Domain\Interfaces\IOrderRepository;
use src\frontoffice\CartCheckout\Domain\ValueObjects\PaymentMethodId;
use src\frontoffice\OrderStatus\Domain\Interfaces\IOrderStatusRepository;
use src\frontoffice\CartCheckout\Domain\Services\PaymentGatewayFactoryService;
use src\frontoffice\PaymentMethods\Domain\Interfaces\IPaymentMethodsRepository;
use src\frontoffice\PaymentMethods\Infrastructure\Persistence\Eloquent\PaymentMethodEloquentModel;

final class CheckoutCartCreator
{
    private $orderRepository;
    private $initialOrderStatus;
    private $paymentGateway;
    private $idInitialOrderStatus;

    public function __construct(IOrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function __invoke(
        OrderId $orderId,
        CustomerId $customerId,
        PaymentMethodId $paymentMethodId,
        IOrderStatusRepository $orderStatusRepository,
        IPaymentMethodsRepository $paymentMethodsRepository,
    ) {
        try {
            $paymentMethod = $paymentMethodsRepository->search($paymentMethodId);

            $peperoni = $paymentMethodsRepository->searchWithInitialOrderStatusName($paymentMethodId);
            Log::info($peperoni);
            $paymentMethodName = $paymentMethod['short_name'];

            $paymentGateway = PaymentGatewayFactoryService::createPaymentGateway($paymentMethodName, $orderStatusRepository);
            $paymentGatewayResponse = $paymentGateway->processPayment(100);
            
            //$paymentMethod = PaymentMethodEloquentModel::where('short_name', 'bank_wire')->first();
            //$initialOrderStatus = $paymentMethod->initialOrderStatus;

            Log::info($paymentMethod['initial_order_status_id']);
            //$initialOrderStatus = $orderStatusRepository->searchByShortName($paymentGatewayResponse['initialOrderStatus']);
            //$initialOrderStatusId = $initialOrderStatus['id'];
            
           /* $customerId = $customerId;
            $paymentMethodId = '';
            $orderStatusId = $initialOrderStatusId;
            $totalPaid = 250;
            */

            /*
            $cartCheckout = CartCheckout::create(
                $cartCheckoutId,
                $idPaymentMethod,
            );
            $this->cartCheckoutRepository->save($cartCheckout);
            */
        } catch (Throwable $e) {
            throw $e;
        }
    }
}
