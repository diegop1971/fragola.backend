<?php

namespace src\frontoffice\CartCheckout\Domain\Interfaces;

interface IStockAvailabilityChecker
{
    public function validate(): void;
}
