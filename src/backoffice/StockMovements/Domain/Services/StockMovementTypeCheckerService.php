<?php

namespace src\backoffice\StockMovements\Domain\Services;

use src\backoffice\Stock\Domain\ValueObjects\StockMovementTypeId;
use src\backoffice\StockMovementType\Domain\StockMovementTypeRepository;
use src\backoffice\Stock\Domain\Interfaces\StockMovementTypeCheckerServiceInterface;

class StockMovementTypeCheckerService implements StockMovementTypeCheckerServiceInterface
{
    public function stockMovementType(StockMovementTypeRepository $stockMovementTypeRepository, StockMovementTypeId $stockMovementTypeId): bool
    {
        $movementType = $stockMovementTypeRepository->search($stockMovementTypeId->value());

        if (!$movementType) {
            throw new \Exception("El tipo de movimiento de stock no existe.");
        }     

        return $movementType['is_positive'];
    }
}