<?php

namespace src\frontoffice\CartCheckout\Domain\Services;

use src\frontoffice\CartCheckout\Domain\Interfaces\IPaymentGateway;

class BankTransferPaymentGateway implements IPaymentGateway
{
    public function processPayment($amount)
    {
        $response = array(
            'success' => true,
            //'paymentMethod' => 'paymentMethodName',
            'initialOrderStatus' => 'awaiting_bank_wire'
        );

        return $response;
    }
}
