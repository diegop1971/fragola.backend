<?php

namespace src\frontoffice\StockMovements\Domain\Interfaces;

use src\frontoffice\StockMovements\Domain\StockMovement;

interface IStockMovementRepository
{
    public function sumStockQuantityByProductId(string $productId): int;

    public function insert(StockMovement $stockMovement): void;
}
