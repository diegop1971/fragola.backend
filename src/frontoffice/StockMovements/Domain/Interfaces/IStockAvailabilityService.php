<?php

namespace src\frontoffice\StockMovements\Domain\Interfaces;

use src\backoffice\Stock\Domain\ValueObjects\SystemStockQuantity;
use src\frontoffice\StockMovements\Domain\ValueObjects\StockProductId;


interface IStockAvailabilityService
{
    public function makeStockOut(StockProductId $productId, SystemStockQuantity $stockQuantity): void;
}