<?php

namespace src\frontoffice\CartCheckout\Domain\Services;

use Illuminate\Support\Facades\Log;
use src\frontoffice\OrderStatus\Domain\Interfaces\IOrderStatusRepository;

class PaymentGatewayFactoryService
{
    public static function createPaymentGateway($paymentMethod, IOrderStatusRepository $orderStatusRepository)
    {
        switch ($paymentMethod->value()) {
            case 'bank_transfer':
                return new BankTransferPaymentGateway();
            case 'wallet':
                return new WalletPaymentGateway();
            case 'cash_on_delivery':
                return new CashOnDeliveryPaymentGateway($orderStatusRepository);
            default:
                throw new \InvalidArgumentException('Invalid payment method');
        }
    }
}
