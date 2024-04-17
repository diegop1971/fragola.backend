<?php

namespace src\backoffice\StockMovements\Domain\Interfaces;

use src\backoffice\Shared\Domain\Stock\StockSystemStockQuantity;
use src\backoffice\Shared\Domain\Stock\StockPhysicalStockQuantity;

interface StockUpdaterServiceInterface 
{
    public function updateStockFromMovement(string $stockProductId, StockSystemStockQuantity $systemStockQuantity, StockPhysicalStockQuantity $physicalStockQuantity): void;
}