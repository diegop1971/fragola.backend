<?php

declare(strict_types=1);

namespace src\frontoffice\CartCheckout\Application\Create;

use Throwable;
use Illuminate\Support\Facades\Log;
use src\frontoffice\CartCheckout\Domain\ValueObjects\OrderId;
use src\frontoffice\Customers\Domain\ValueObjects\CustomerId;
use src\frontoffice\Orders\Domain\Interfaces\IOrderRepository;
use src\frontoffice\CartCheckout\Domain\PaymentProcessingException;
use src\frontoffice\CartCheckout\Domain\ValueObjects\PaymentMethodId;
use src\frontoffice\OrderStatus\Domain\Interfaces\IOrderStatusRepository;
use src\frontoffice\CartCheckout\Domain\Services\PaymentGatewayFactoryService;
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
        CustomerId $customerId,
        PaymentMethodId $paymentMethodId,
        IOrderStatusRepository $orderStatusRepository,
        IPaymentMethodsRepository $paymentMethodsRepository,
    ) {
        try {
            $paymentMethod = $paymentMethodsRepository->searchWithInitialOrderStatusName($paymentMethodId);
            $paymentMethodName = $paymentMethod['short_name'];
            
            $paymentGateway = PaymentGatewayFactoryService::createPaymentGateway($paymentMethodName, $orderStatusRepository);
            // por ahora las clases encargadas de cada tipo de pago solo devuelven success => true, luego irá la lógica correspondiente
            $paymentGatewayResponse = $paymentGateway->processPayment(100);            
            
            /*
            $customerId = $customerId;
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
