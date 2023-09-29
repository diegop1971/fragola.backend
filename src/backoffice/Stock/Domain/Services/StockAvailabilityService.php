<?php

namespace src\backoffice\Stock\Domain\Services;

use Illuminate\Validation\ValidationException;
use src\backoffice\Stock\Domain\ValueObjects\StockQuantity;
use src\backoffice\Stock\Domain\ValueObjects\StockProductId;
use src\backoffice\Stock\Domain\ValueObjects\StockMovementTypeId;
use src\backoffice\Stock\Domain\Interfaces\StockRepositoryInterface;
use src\backoffice\StockMovementType\Domain\StockMovementTypeRepository;
use src\backoffice\Stock\Domain\Interfaces\StockAvailabilityServiceInterface;

class StockAvailabilityService implements StockAvailabilityServiceInterface
{
    public function __construct(
                                private StockMovementTypeRepository $stockMovementTypeRepository,
                                private StockRepositoryInterface $stockRepository
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
                throw new ValidationException("El producto no tiene stock registrado.");
            }

            $quantity = abs($stockQuantity->value());

            if ($quantity > $countStockByProductId) {
                throw ValidationException::withMessages([
                    'quantity' => "No se puede hacer la salida de stock. Cantidad insuficiente en existencia. Cantidad en existencia: $countStockByProductId, Cantidad que pretende sacar: $quantity",
                ]);
            }
        }
    }
}
