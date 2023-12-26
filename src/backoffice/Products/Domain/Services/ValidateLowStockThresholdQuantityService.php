<?php
namespace src\backoffice\Products\Domain\Services;

use Illuminate\Validation\ValidationException;
use src\backoffice\Products\Domain\ValueObjects\ProductMinimumQuantity;
use src\backoffice\Products\Domain\ValueObjects\ProductLowStockThreshold;
use src\backoffice\Products\Domain\Interfaces\IValidateLowStockThresholdQuantity;

class ValidateLowStockThresholdQuantityService implements IValidateLowStockThresholdQuantity
{
    public function validateLowStockThresholdQuantity(ProductLowStockThreshold  $productLowStockThreshold, ProductMinimumQuantity $productMinimumQuantity): void
    {       
        if ($productLowStockThreshold->value() <= $productMinimumQuantity->value()) {
            throw ValidationException::withMessages([
                'error' => "Low Stock Threshold debe ser igual o mayor que minimum quantity.",
            ]);
        }
    }
}