<?php

namespace src\frontoffice\CartCheckout\Domain\Services;

use Illuminate\Support\Facades\Log;

class PaymentGatewayFactoryService {
    public static function createPaymentGateway($paymentMethod) {
        switch ($paymentMethod->value()) {
            case 'bank_transfer':
                return new BankTransferPaymentGateway();
            case 'wallet':
                return new WalletPaymentGateway();
            case 'cash_on_delivery':
                return new CashOnDeliveryPaymentGateway();
            default:
                throw new \InvalidArgumentException('Forma de pago no válida');
        }
    }
}