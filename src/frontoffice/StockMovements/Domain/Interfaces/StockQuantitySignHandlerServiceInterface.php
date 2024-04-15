<?php

namespace src\frontoffice\StockMovements\Domain\Interfaces;

use src\frontoffice\Shared\Domain\Stock\StockQuantity;

interface StockQuantitySignHandlerServiceInterface
{
    public function setStockQuantitySign(int $stockMovementType, StockQuantity $quantity): StockQuantity;
}