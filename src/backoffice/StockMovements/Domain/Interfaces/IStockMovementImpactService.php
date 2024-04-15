<?php

namespace src\backoffice\StockMovements\Domain\Services;

use PhpParser\Builder\Interface_;

interface IStockMovementImpactService
{
    public function calculateStockQuantityEffect($stockQuantity, $stockMovementType): int;
}