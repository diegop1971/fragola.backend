<?php

namespace src\backoffice\StockMovements\Domain\Services;

use Illuminate\Validation\ValidationException;
use src\backoffice\StockMovements\Domain\ValueObjects\StockQuantity;
use src\backoffice\StockMovements\Domain\ValueObjects\StockProductId;
use src\backoffice\StockMovements\Domain\ValueObjects\StockMovementTypeId;
use src\backoffice\StockMovements\Domain\Interfaces\IStockRepository;
use src\backoffice\StockMovementType\Domain\StockMovementTypeRepository;
use src\backoffice\StockMovements\Domain\Interfaces\StockAvailabilityServiceInterface;

class StockAvailabilityService implements StockAvailabilityServiceInterface
{
    public function __construct(
                                private StockMovementTypeRepository $stockMovementTypeRepository,
                                private IStockRepository $stockRepository
                            )
    {
        $this->stockRepository = $stockRepository;
    }

    public function makeStockOut(StockProductId $stockProductId, StockQuantity $stockQuantity, StockMovementTypeId $stockMovementTypeId): void
    {
        $movementType = $this->stockMovementTypeRepository->search($stockMovementTypeId->value());

        if(!$movementType['is_positive']) {
            $countStockByProductId = $this->stockRepository->sumStockQuantityByProductId($stockProductId->value());

            if ($countStockByProductId === null) {
                throw new ValidationException("The product has no stock registered.");
            }

            $quantity = abs($stockQuantity->value());

            if ($quantity > $countStockByProductId) {
                throw ValidationException::withMessages([
                    'quantity' => "Stock output cannot be performed. Insufficient quantity in stock. Quantity in stock: $countStockByProductId, Quantity intending to be withdrawn: $quantity",
                ]);
            }
        }
    }
}
