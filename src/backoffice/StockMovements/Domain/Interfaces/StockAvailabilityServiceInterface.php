<?php

namespace src\backoffice\StockMovements\Domain\Interfaces;

use src\backoffice\Shared\Domain\Stock\StockQuantity;
use src\backoffice\Shared\Domain\Stock\StockProductId;
use src\backoffice\Shared\Domain\StockMovementType\StockMovementTypeId;

interface StockAvailabilityServiceInterface
{
    public function makeStockOut(StockProductId $productId, StockQuantity $stockQuantity, StockMovementTypeId $stockMovementTypeId): void;
}