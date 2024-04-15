<?php

namespace src\backoffice\StockMovements\Domain\Services;

use src\backoffice\StockMovements\Domain\Services\IStockMovementImpactService;

class StockMovementImpactService implements IStockMovementImpactService
{
    public function calculateStockQuantityEffect($stockQuantity, $stockMovementType): int
    {
        return 0;
    }
}