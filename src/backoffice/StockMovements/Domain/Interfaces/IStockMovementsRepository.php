<?php

namespace src\backoffice\StockMovements\Domain\Interfaces;

use src\backoffice\StockMovements\Domain\StockMovements;

interface IStockMovementsRepository
{
    public function getStockListByProductId(string $id): ?array;

    public function save(StockMovements $stock): void;

    public function sumStockQuantityByProductId(string $productId): int;

}
