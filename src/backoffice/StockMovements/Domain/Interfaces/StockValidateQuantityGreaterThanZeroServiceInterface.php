<?php

namespace src\backoffice\StockMovements\Domain\Interfaces;

use src\backoffice\Shared\Domain\Stock\StockQuantity;

interface StockValidateQuantityGreaterThanZeroServiceInterface
{
    public function validateQuantityGreaterThanZero(StockQuantity $stockQuantity): bool;
}