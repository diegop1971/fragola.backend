<?php

namespace src\backoffice\StockMovements\Domain\Interfaces;

use src\backoffice\Shared\Domain\Stock\StockQuantity;

interface IStockQuantityImpactHandlerService
{
    public function setStockQuantitySign(int $stockMovementType, StockQuantity $quantity): StockQuantity;
}