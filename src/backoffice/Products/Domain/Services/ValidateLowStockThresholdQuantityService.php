<?php

namespace src\backoffice\Products\Domain\Services;

use src\backoffice\Products\Domain\ValueObjects\ProductLowStockThreshold;
use src\backoffice\Products\Domain\Interfaces\IValidateLowStockThresholdQuantity;

class ValidateLowStockThresholdQuantityService implements IValidateLowStockThresholdQuantity
{
    public function validateLowStockThresholdQuantity(ProductLowStockThreshold  $productLowStockThreshold): void
    {
        if ($productLowStockThreshold->value() <= 0) {
            throw new \InvalidArgumentException("Low Stock Threshold debe ser mayor que 0.", 422);
        }
    }
}
