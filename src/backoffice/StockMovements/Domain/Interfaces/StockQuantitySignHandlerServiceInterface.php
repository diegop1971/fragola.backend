<?php

namespace src\backoffice\StockMovements\Domain\Interfaces;

use src\backoffice\StockMovements\Domain\ValueObjects\StockQuantity;

interface StockQuantitySignHandlerServiceInterface
{
    public function setStockQuantitySign(int $stockMovementType, StockQuantity $quantity): StockQuantity;
}