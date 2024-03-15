<?php

namespace src\frontoffice\CartCheckout\Domain\Services;

use Illuminate\Support\Facades\Log;
use src\frontoffice\CartCheckout\Domain\Interfaces\IPaymentGateway;

class BankTransferPaymentGateway implements IPaymentGateway {
    public function processPayment($amount) {
        // Lógica para procesar el pago mediante transferencia bancaria
        Log::info('soy una instancia de BankTransferPaymentGateway');
    }
}