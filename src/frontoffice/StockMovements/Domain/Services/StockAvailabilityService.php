<?php

namespace src\frontoffice\StockMovements\Domain\Services;

use Illuminate\Validation\ValidationException;
use src\frontoffice\StockMovements\Domain\ValueObjects\StockQuantity;
use src\frontoffice\StockMovements\Domain\ValueObjects\StockProductId;
use src\backoffice\StockMovementType\Domain\StockMovementTypeRepository;
use src\frontoffice\StockMovements\Domain\Interfaces\IStockMovementRepository;
use src\frontoffice\StockMovements\Domain\Interfaces\IStockAvailabilityService;

class StockAvailabilityService implements IStockAvailabilityService
{
    public function __construct(
        private StockMovementTypeRepository $stockMovementTypeRepository,
        private IStockMovementRepository $stockRepository
    ) {
        $this->stockRepository = $stockRepository;
    }

    public function makeStockOut(StockProductId $stockProductId, StockQuantity $stockQuantity): void
    {
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
