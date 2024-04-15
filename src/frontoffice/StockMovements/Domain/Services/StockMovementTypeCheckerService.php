<?php

namespace src\frontoffice\StockMovements\Domain\Services;

use Illuminate\Validation\ValidationException;
use src\frontoffice\StockMovementType\Domain\IStockMovementTypeRepository;
use src\frontoffice\StockMovements\Domain\ValueObjects\StockMovementTypeId;
use src\frontoffice\StockMovements\Domain\Interfaces\StockMovementTypeCheckerServiceInterface;

class StockMovementTypeCheckerService implements StockMovementTypeCheckerServiceInterface
{
    public function stockMovementType(IStockMovementTypeRepository $stockMovementTypeRepository, StockMovementTypeId $stockMovementTypeId): int
    {
        $movementType = $stockMovementTypeRepository->search($stockMovementTypeId->value());
        if (!$movementType) {
            throw ValidationException::withMessages([
                'movement_type_id' => "El tipo de movimiento de stock no existe."
            ]);
        }

        return $movementType['is_positive_system'];
    }
}
