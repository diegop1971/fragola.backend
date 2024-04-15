<?php

namespace src\backoffice\Stock\Domain\Interfaces;

use src\backoffice\Shared\Domain\StockMovementType\StockMovementTypeId;
use src\backoffice\StockMovementType\Domain\StockMovementTypeRepository;

interface StockMovementTypeCheckerServiceInterface
{
    public function stockMovementType(StockMovementTypeRepository $stockMovementTypeRepository, StockMovementTypeId $stockMovementTypeId): bool;
}