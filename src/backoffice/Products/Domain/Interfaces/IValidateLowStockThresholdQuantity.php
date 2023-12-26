<?php

namespace src\backoffice\Products\Domain\Interfaces;

use src\backoffice\Products\Domain\ValueObjects\ProductMinimumQuantity;
use src\backoffice\Products\Domain\ValueObjects\ProductLowStockThreshold;

interface IValidateLowStockThresholdQuantity
{
    public function validateLowStockThresholdQuantity(ProductLowStockThreshold  $productLowStockThreshold, ProductMinimumQuantity $productMinimumQuantity): void;
}