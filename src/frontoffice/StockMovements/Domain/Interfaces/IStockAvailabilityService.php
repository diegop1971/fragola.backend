<?php

namespace src\frontoffice\StockMovements\Domain\Interfaces;

use src\frontoffice\Shared\Domain\Stock\StockProductId;
use src\frontoffice\Shared\Domain\Stock\StockSystemStockQuantity;

interface IStockAvailabilityService
{
    public function makeStockOut(StockProductId $productId, StockSystemStockQuantity $stockQuantity): void;
}