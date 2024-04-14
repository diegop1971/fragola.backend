<?php

namespace src\backoffice\StockMovements\Domain\Services;

use src\backoffice\StockMovements\Domain\ValueObjects\StockQuantity;
use src\backoffice\StockMovements\Domain\Interfaces\StockQuantitySignHandlerServiceInterface;

class StockQuantitySignHandlerService implements StockQuantitySignHandlerServiceInterface
{
    public function setStockQuantitySign(int $stockMovementType, StockQuantity $stockQuantity): StockQuantity
    {
        //$stockQuantity = $stockMovementType ? $quantity : new StockQuantity($quantity->value() * -1);

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
