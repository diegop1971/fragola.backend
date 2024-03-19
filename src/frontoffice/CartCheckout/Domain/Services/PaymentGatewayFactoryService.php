<?php

namespace src\frontoffice\CartCheckout\Domain\Services;

use Illuminate\Support\Facades\Log;
use src\frontoffice\CartCheckout\Domain\Services\WalletPaymentGateway;
use src\frontoffice\OrderStatus\Domain\Interfaces\IOrderStatusRepository;
use src\frontoffice\CartCheckout\Domain\Services\BankTransferPaymentGateway;
use src\frontoffice\CartCheckout\Domain\Services\CashOnDeliveryPaymentGateway;

class PaymentGatewayFactoryService
{
    public static function createPaymentGateway($paymentMethod, IOrderStatusRepository $orderStatusRepository)
    {
        switch ($paymentMethod) {
            case 'bank_wire':
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
