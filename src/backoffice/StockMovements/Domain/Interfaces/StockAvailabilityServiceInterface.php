<?php

namespace src\backoffice\StockMovements\Domain\Interfaces;

use src\backoffice\StockMovements\Domain\ValueObjects\StockQuantity;
use src\backoffice\StockMovements\Domain\ValueObjects\StockProductId;
use src\backoffice\StockMovements\Domain\ValueObjects\StockMovementTypeId;

interface StockAvailabilityServiceInterface
{
    public function makeStockOut(StockProductId $productId, StockQuantity $stockQuantity, StockMovementTypeId $stockMovementTypeId): void;
}