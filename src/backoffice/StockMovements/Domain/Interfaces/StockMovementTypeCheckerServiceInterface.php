<?php

namespace src\backoffice\StockMovements\Domain\Interfaces;

use src\backoffice\StockMovements\Domain\ValueObjects\StockMovementTypeId;
use src\backoffice\StockMovementType\Domain\StockMovementTypeRepository;

interface StockMovementTypeCheckerServiceInterface
{
    public function stockMovementType(StockMovementTypeRepository $stockMovementTypeRepository, StockMovementTypeId $stockMovementTypeId): bool;
}