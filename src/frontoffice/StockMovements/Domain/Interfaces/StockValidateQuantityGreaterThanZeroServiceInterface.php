<?php

namespace src\frontoffice\StockMovements\Domain\Interfaces;

use src\frontoffice\Shared\Domain\Stock\StockQuantity;

interface StockValidateQuantityGreaterThanZeroServiceInterface
{
    public function validateQuantityGreaterThanZero(StockQuantity $stockQuantity): bool;
}