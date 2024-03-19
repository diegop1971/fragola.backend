<?php

namespace src\frontoffice\CartCheckout\Domain\Services;

use src\frontoffice\CartCheckout\Domain\Interfaces\IPaymentGateway;
use src\frontoffice\OrderStatus\Domain\Interfaces\IOrderStatusRepository;

class CashOnDeliveryPaymentGateway implements IPaymentGateway
{
    private $orderStatusRepository;

    public function __construct(IOrderStatusRepository $orderStatusRepository)
    {
        $this->orderStatusRepository = $orderStatusRepository;
    }

    public function processPayment($amount)
    {
        $response = array(
            'success' => true,
            //'paymentMethod' => 'paymentMethodName',
            'initialOrderStatus' => 'awaiting_cash_payment'
        );

        return $response;
    }
}
