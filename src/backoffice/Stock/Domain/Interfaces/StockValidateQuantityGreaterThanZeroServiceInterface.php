<?php

namespace src\backoffice\Stock\Domain\Interfaces;

use src\backoffice\Stock\Domain\ValueObjects\StockQuantity;

interface StockValidateQuantityGreaterThanZeroServiceInterface
{
    public function validateQuantityGreaterThanZero(StockQuantity $stockQuantity): bool;
}