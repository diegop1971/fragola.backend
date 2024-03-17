<?php

declare(strict_types=1);

namespace src\frontoffice\CartCheckout\Application\Create;

use Throwable;
use Illuminate\Support\Facades\Log;
use src\frontoffice\CartCheckout\Domain\ValueObjects\CartCheckoutId;
use src\frontoffice\CartCheckout\Domain\ValueObjects\PaymentMethodName;
use src\frontoffice\OrderStatus\Domain\Interfaces\IOrderStatusRepository;
use src\frontoffice\CartCheckout\Domain\Services\PaymentGatewayFactoryService;

final class CheckoutCartCreator
{
    private $initialOrderStatus;
    private $paymentGateway;
    private $idInitialOrderStatus;

    public function __construct()
    {
    }

    public function __invoke(
        CartCheckoutId $cartCheckoutId,
        PaymentMethodName $paymentMethodName,
        IOrderStatusRepository $orderStatusRepository
    ) {
        try {
            /**
             * recibe $paymentMethodName
             * envía $paymentMethodName a PaymentGatewayFactoryService para que lo procese la clase que corresponda según el método de pago
             * PaymentGatewayFactoryService devuelve $initialOrderStatus que sirve para:
             * recuperar el id del $initialOrderStatus de su repositorio OrderStatusRepository
             * una vez que tenemos el id de $initialStatus ver si tenemos todos los datos para guardar la orden mediante el repositorio que corresponda
             */
            $paymentGateway = PaymentGatewayFactoryService::createPaymentGateway($paymentMethodName, $orderStatusRepository);

            $paymentGatewayResponse = $paymentGateway->processPayment(100);

            $initialOrderStatus = $orderStatusRepository->searchByShortName($paymentGatewayResponse['initialOrderStatus']);

            $idInitialOrderStatus = $initialOrderStatus['id'];

            log::info($idInitialOrderStatus);


            /*
            $cartCheckout = CartCheckout::create(
                $cartCheckoutId,
                $idPaymentMethod,
            );
            $this->cartCheckoutRepository->save($cartCheckout);
            */
        } catch (Throwable $e) {
            Log::info($e->getMessage());
        }
    }
}
