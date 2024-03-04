<?php

namespace src\backoffice\StockMovements\Domain\Services;

use Illuminate\Validation\ValidationException;
use src\backoffice\StockMovementType\Domain\StockMovementTypeRepository;
use src\backoffice\StockMovements\Domain\ValueObjects\StockMovementTypeId;
use src\backoffice\StockMovements\Domain\Interfaces\StockMovementTypeCheckerServiceInterface;

class StockMovementTypeCheckerService implements StockMovementTypeCheckerServiceInterface
{
    public function stockMovementType(StockMovementTypeRepository $stockMovementTypeRepository, StockMovementTypeId $stockMovementTypeId): bool
    {
        $movementType = $stockMovementTypeRepository->search($stockMovementTypeId->value());
        if (!$movementType) {
            throw ValidationException::withMessages([
                'movement_type_id' => "El tipo de movimiento de stock no existe."
            ]);
        }

        return $movementType['is_positive'];
    }
}
