<?php

namespace src\frontoffice\StockMovements\Domain\Services;


use src\frontoffice\Shared\Domain\Stock\StockQuantity;
use src\frontoffice\StockMovements\Domain\Interfaces\StockQuantitySignHandlerServiceInterface;

class StockQuantitySignHandlerService implements StockQuantitySignHandlerServiceInterface
{
    public function setStockQuantitySign(int $stockMovementType, StockQuantity $quantity): StockQuantity
    {
        $stockQuantity = $stockMovementType ? $quantity : new StockQuantity($quantity->value() * -1);
        
        return $stockQuantity;
    }
}
