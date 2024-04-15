<?php

namespace src\backoffice\StockMovements\Domain\Interfaces;

use src\backoffice\Shared\Domain\Stock\StockQuantity;

interface StockQuantitySignHandlerServiceInterface
{
    public function setStockQuantitySign(int $stockMovementType, StockQuantity $quantity): StockQuantity;
}