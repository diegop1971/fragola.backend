<?php

namespace src\backoffice\StockMovements\Domain\Services;

use Illuminate\Validation\ValidationException;
use src\backoffice\Shared\Domain\Stock\StockQuantity;
use src\backoffice\StockMovements\Domain\Interfaces\StockValidateQuantityGreaterThanZeroServiceInterface;

class StockValidateQuantityGreaterThanZeroService implements StockValidateQuantityGreaterThanZeroServiceInterface
{
    public function validateQuantityGreaterThanZero(StockQuantity $stockQuantity): bool
    {       
        if ($stockQuantity->value() <= 0) {
            throw ValidationException::withMessages([
                'quantity' => "The quantity must be greater than zero.",
            ]);
        }
        return true;
    }
}