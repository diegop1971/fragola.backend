<?php

namespace src\backoffice\StockMovements\Domain\Interfaces;

use src\backoffice\StockMovements\Domain\ValueObjects\StockQuantity;

interface StockValidateQuantityGreaterThanZeroServiceInterface
{
    public function validateQuantityGreaterThanZero(StockQuantity $stockQuantity): bool;
}