<?php

namespace src\backoffice\StockMovements\Domain\Services;

use src\backoffice\Shared\Domain\Stock\StockQuantity;
use src\backoffice\StockMovements\Domain\Interfaces\IStockQuantityImpactHandlerService;

class StockQuantityImpactHandlerService implements IStockQuantityImpactHandlerService
{
    public function setStockQuantitySign(int $stockMovementType, StockQuantity $stockQuantity): StockQuantity
    {
        switch ($stockMovementType) {
            case 1:
                $stockQuantity = new StockQuantity($stockQuantity->value());
                break;
            case 0:
                $stockQuantity = new StockQuantity(0);
                break;
            case -1:
                $stockQuantity = new StockQuantity($stockQuantity->value() * -1);
                break;
        }

        return $stockQuantity;
    }
}
