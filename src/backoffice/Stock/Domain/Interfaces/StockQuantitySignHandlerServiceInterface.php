<?php

namespace src\backoffice\Stock\Domain\Interfaces;

use src\backoffice\Shared\Domain\Stock\StockQuantity;

interface StockQuantitySignHandlerServiceInterface
{
    public function setStockQuantitySign(bool $stockMovementType, StockQuantity $quantity): StockQuantity;
}