<?php

namespace src\frontoffice\CartCheckout\Domain\Services;

use src\frontoffice\CartCheckout\Domain\Interfaces\IPaymentGateway;
use src\frontoffice\CartCheckout\Domain\PaymentProcessingException;

class CashOnDeliveryPaymentGateway implements IPaymentGateway
{
    public function processPayment($amount)
    {
        /* 
        Lógica adicional para procesar el pago en efectivo ...
        si la validacion falla lanzar esta exception:
        
        if (!$validationPayment) {
            throw new PaymentProcessingException();
        }
        */
        $response = array(
            'success' => true,
            'message' => 'CashOnDeliveryPaymentGateway'
        );

        return $response;
    }
}
