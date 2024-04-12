<?php

namespace src\frontoffice\StockMovements\Domain\Interfaces;

use src\frontoffice\StockMovements\Domain\ValueObjects\StockQuantity;
use src\frontoffice\StockMovements\Domain\ValueObjects\StockProductId;

interface IStockAvailabilityService
{
    public function makeStockOut(StockProductId $productId, StockQuantity $stockQuantity): void;
}