<?php

namespace src\frontoffice\StockMovements\Domain\Services;

use Illuminate\Validation\ValidationException;
use src\backoffice\StockMovements\Domain\Interfaces\StockValidateQuantityGreaterThanZeroServiceInterface;
use src\backoffice\StockMovements\Domain\ValueObjects\StockQuantity;

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