<?php

namespace src\backoffice\StockMovements\Domain\Interfaces;

use src\backoffice\StockMovements\Domain\StockMovements;

interface IStockRepository
{
    public function searchAll(): ?array;

    public function search(string $id): ?array;

    public function getStockListByProductId(string $id): ?array;

    public function getStockGroupedByProductId(): ?array;

    public function save(StockMovements $stock): void;

    public function update(StockMovements $stock): void;
    
    public function delete(string $id): void;

    public function getStockByProductId(string $productId): ?array;

    public function sumStockQuantityByProductId(string $productId): int;

    public function countStockByProductId(string $productId): ?int;

    public function groupByProductWithDetails();
}
