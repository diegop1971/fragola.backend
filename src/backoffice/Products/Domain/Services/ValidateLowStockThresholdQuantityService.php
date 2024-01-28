<?php
namespace src\backoffice\Products\Domain\Services;

use Illuminate\Support\Facades\Log;
use src\backoffice\Products\Domain\ValueObjects\ProductMinimumQuantity;
use src\backoffice\Products\Domain\ValueObjects\ProductLowStockThreshold;
use src\backoffice\Products\Domain\Interfaces\IValidateLowStockThresholdQuantity;

class ValidateLowStockThresholdQuantityService implements IValidateLowStockThresholdQuantity
{
    public function validateLowStockThresholdQuantity(ProductLowStockThreshold  $productLowStockThreshold, ProductMinimumQuantity $productMinimumQuantity): void
    {     
        Log::info('validateLowStockThresholdQuantity');  
        if ($productLowStockThreshold->value() <= $productMinimumQuantity->value()) {
            throw new \InvalidArgumentException("Low Stock Threshold debe ser igual o mayor que minimum quantity.", 422);
        }
    }
}