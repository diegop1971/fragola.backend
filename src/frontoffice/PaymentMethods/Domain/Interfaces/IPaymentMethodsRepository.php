<?php

namespace src\frontoffice\PaymentMethods\Domain\Interfaces;

interface IPaymentMethodsRepository
{
    public function searchAll(): ?array;

    public function search($id): ?array;

    public function searchWithInitialOrderStatusName($id): ?array;
}
