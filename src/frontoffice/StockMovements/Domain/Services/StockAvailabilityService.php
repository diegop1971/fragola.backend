<?php

namespace src\frontoffice\StockMovements\Domain\Services;

use Illuminate\Validation\ValidationException;
use src\frontoffice\Shared\Domain\Stock\StockProductId;
use src\frontoffice\Shared\Domain\Stock\StockSystemStockQuantity;
use src\frontoffice\StockMovements\Domain\Interfaces\IStockMovementRepository;
use src\frontoffice\StockMovements\Domain\Interfaces\IStockAvailabilityService;

class StockAvailabilityService implements IStockAvailabilityService
{
    public function __construct(
        private IStockMovementRepository $stockRepository
    ) {
        $this->stockRepository = $stockRepository;
    }

    public function makeStockOut(StockProductId $productId, StockSystemStockQuantity $stockQuantity): void
    {
        $countStockByProductId = $this->stockRepository->sumStockQuantityByProductId($productId->value());

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
