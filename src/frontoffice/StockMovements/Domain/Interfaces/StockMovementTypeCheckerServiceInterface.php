<?php

namespace src\frontoffice\StockMovements\Domain\Interfaces;

use src\frontoffice\StockMovementType\Domain\IStockMovementTypeRepository;
use src\frontoffice\StockMovements\Domain\ValueObjects\StockMovementTypeId;

interface StockMovementTypeCheckerServiceInterface
{
    public function stockMovementType(IStockMovementTypeRepository $stockMovementTypeRepository, StockMovementTypeId $stockMovementTypeId): int;
}