<?php

namespace src\backoffice\StockMovements\Domain\Interfaces;

use src\backoffice\Stock\Domain\ValueObjects\StockMovementTypeId;
use src\backoffice\StockMovementType\Domain\StockMovementTypeRepository;

interface StockMovementTypeCheckerServiceInterface
{
    public function stockMovementType(StockMovementTypeRepository $stockMovementTypeRepository, StockMovementTypeId $stockMovementTypeId): bool;
}