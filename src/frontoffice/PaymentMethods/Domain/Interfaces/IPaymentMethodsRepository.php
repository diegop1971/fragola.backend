<?php

namespace src\frontoffice\PaymentMethods\Domain\Interfaces;

interface IPaymentMethodsRepository
{
    public function searchAll(): ?array;
}
