<?php

namespace src\backoffice\StockMovements\Domain\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use src\backoffice\Shared\Domain\StockMovementType\StockMovementTypeId;
use src\backoffice\StockMovementType\Domain\IStockMovementTypeRepository;
use src\backoffice\StockMovements\Domain\Interfaces\IStockMovementTypeFetcherService;

class StockMovementTypeFetcherService implements IStockMovementTypeFetcherService
{
    private $stockMovementTypeRepository;

    public function __construct(IStockMovementTypeRepository $stockMovementTypeRepository)
    {
        $this->stockMovementTypeRepository = $stockMovementTypeRepository;
    }

    public function stockMovementType(StockMovementTypeId $stockMovementTypeId): array
    {
        $movementType = $this->stockMovementTypeRepository->search($stockMovementTypeId->value());
        if (!$movementType) {
            throw ValidationException::withMessages([
                'movement_type_id' => "El tipo de movimiento de stock no existe."
            ]);
        }
        return $movementType;
    }
}
