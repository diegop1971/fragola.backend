<?php

namespace src\backoffice\StockMovements\Domain\Services;

use src\backoffice\StockMovements\Domain\ValueObjects\StockQuantity;
use src\backoffice\StockMovements\Domain\Interfaces\StockQuantitySignHandlerServiceInterface;

class StockQuantitySignHandlerService implements StockQuantitySignHandlerServiceInterface
{
    public function setStockQuantitySign(bool $stockMovementType, StockQuantity $quantity): StockQuantity
    {
        $stockQuantity = $stockMovementType ? $quantity : new StockQuantity($quantity->value() * -1);
        
        return $stockQuantity;
    }
}
