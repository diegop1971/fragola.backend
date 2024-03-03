<?php

namespace src\backoffice\StockMovements\Domain\Interfaces;

use src\backoffice\StockMovements\Domain\ValueObjects\StockQuantity;
use src\backoffice\StockMovements\Domain\ValueObjects\StockProductId;

interface StockUpdaterServiceInterface 
{
    public function updateStockFromMovement(string $stockProductId, int $stockQuantity): void;
}