<?php

namespace src\frontoffice\CartCheckout\Domain\Services;

use Illuminate\Support\Facades\Log;
use src\frontoffice\CartCheckout\Domain\Interfaces\IPaymentGateway;

class CashOnDeliveryPaymentGateway implements IPaymentGateway
{
    public function processPayment($amount)
    {
        // Lógica para procesar el pago en efectivo contra entrega
        Log::info('soy una instancia de CashOnDeliveryPaymentGateway');
    }
}
