<?php

namespace src\backoffice\StockMovements\Domain\Interfaces;

interface StockUpdaterServiceInterface 
{
    public function updateStockFromMovement(string $stockProductId, int $stockQuantity): void;
}