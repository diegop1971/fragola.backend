<?php

namespace src\frontoffice\CartCheckout\Domain\Services;

use Illuminate\Support\Facades\Log;
use src\frontoffice\CartCheckout\Domain\Interfaces\IPaymentGateway;

class WalletPaymentGateway implements IPaymentGateway {
    public function processPayment($amount) {
        // Lógica para procesar el pago mediante billetera electrónica
        Log::info('soy una instancia de WalletPaymentGateway');
    }
}