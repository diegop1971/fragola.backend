<?php

namespace src\frontoffice\CartCheckout\Domain\Interfaces;

interface IPaymentGateway
{
    public function processPayment($amount);
}
