<?php

namespace src\frontoffice\StockMovements\Domain\Services;

use Illuminate\Validation\ValidationException;

use src\frontoffice\Shared\Domain\Stock\StockQuantity;
use src\frontoffice\StockMovements\Domain\Interfaces\StockValidateQuantityGreaterThanZeroServiceInterface;

class StockValidateQuantityGreaterThanZeroService implements StockValidateQuantityGreaterThanZeroServiceInterface
{
    public function validateQuantityGreaterThanZero(StockQuantity $stockQuantity): bool
    {       
        if ($stockQuantity->value() <= 0) {
            throw ValidationException::withMessages([
                'quantity' => "La cantidad debe ser mayor a cero.",
            ]);
        }
        return true;
    }
}