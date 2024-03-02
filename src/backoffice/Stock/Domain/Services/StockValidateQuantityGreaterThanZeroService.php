<?php

namespace src\backoffice\Stock\Domain\Services;

use Illuminate\Validation\ValidationException;
use src\backoffice\Stock\Domain\Interfaces\StockValidateQuantityGreaterThanZeroServiceInterface;
use src\backoffice\Stock\Domain\ValueObjects\StockQuantity;

class StockValidateQuantityGreaterThanZeroService implements StockValidateQuantityGreaterThanZeroServiceInterface
{
    public function validateQuantityGreaterThanZero(StockQuantity $stockQuantity): bool
    {       
        if ($stockQuantity->value() <= 0) {
            throw ValidationException::withMessages([
                'quantity' => "La cantidad debe ser mayor a cero000.",
            ]);
        }
        return true;
    }
}