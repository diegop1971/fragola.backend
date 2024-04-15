<?php

namespace src\backoffice\StockMovements\Domain\Interfaces;

use src\backoffice\Shared\Domain\StockMovementType\StockMovementTypeId;

interface IStockMovementTypeFetcherService
{
    public function stockMovementType(StockMovementTypeId $stockMovementTypeId): array;
}