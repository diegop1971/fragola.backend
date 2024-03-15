<?php

declare(strict_types=1);

namespace src\frontoffice\CartCheckout\Application\Create;

use Throwable;
use Illuminate\Support\Facades\Log;
use src\frontoffice\CartCheckout\Domain\ValueObjects\CartCheckoutId;
use src\frontoffice\CartCheckout\Domain\ValueObjects\PaymentMethodName;
use src\frontoffice\CartCheckout\Domain\Services\PaymentGatewayFactoryService;

final class CheckoutCartCreator
{
    private $paymentMethod;

    public function __construct()
    {
    }

    public function __invoke(
        CartCheckoutId $cartCheckoutId,
        PaymentMethodName $paymentMethodName,
    ) {
        try {
            $this->paymentMethod = PaymentGatewayFactoryService::createPaymentGateway($paymentMethodName);
            $this->paymentMethod->processPayment(100);
            
            /*$cartCheckout = CartCheckout::create(
            $cartCheckoutId,
            $idPaymentMethod,
        );

        $this->cartCheckoutRepository->save($cartCheckout);*/
        } catch (Throwable $e) {
            Log::info($e->getMessage());
        }
    }
}
