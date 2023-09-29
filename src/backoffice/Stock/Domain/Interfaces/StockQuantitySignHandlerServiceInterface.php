<?php

namespace src\backoffice\Stock\Domain\Interfaces;

use src\backoffice\Stock\Domain\ValueObjects\StockQuantity;

interface StockQuantitySignHandlerServiceInterface
{
    public function setStockQuantitySign(bool $stockMovementType, StockQuantity $quantity): StockQuantity;
}