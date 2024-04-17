<?php

namespace src\backoffice\StockMovements\Domain\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use src\backoffice\Shared\Domain\Stock\StockQuantity;
use src\backoffice\Shared\Domain\Stock\StockProductId;
use src\backoffice\StockMovements\Domain\Interfaces\IStockMovementsRepository;
use src\backoffice\StockMovements\Domain\Interfaces\StockAvailabilityServiceInterface;

class StockAvailabilityService implements StockAvailabilityServiceInterface
{
    public function __construct(
        private IStockMovementsRepository $stockRepository
    ) {
        $this->stockRepository = $stockRepository;
    }

    public function makeStockOut(StockProductId $stockProductId, StockQuantity $stockQuantity, int $isPositiveSystem): void
    {
        if ($isPositiveSystem === -1) {
            
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
