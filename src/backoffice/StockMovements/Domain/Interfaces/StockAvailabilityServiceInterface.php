<?php

namespace src\backoffice\StockMovements\Domain\Interfaces;

use src\backoffice\Stock\Domain\ValueObjects\StockQuantity;
use src\backoffice\Stock\Domain\ValueObjects\StockProductId;
use src\backoffice\Stock\Domain\ValueObjects\StockMovementTypeId;

interface StockAvailabilityServiceInterface
{
    public function makeStockOut(StockProductId $productId, StockQuantity $stockQuantity, StockMovementTypeId $stockMovementTypeId): void;
}