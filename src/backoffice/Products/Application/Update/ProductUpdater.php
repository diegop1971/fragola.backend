<?php

declare(strict_types=1);

namespace src\backoffice\Products\Application\Update;

use src\backoffice\Products\Domain\Product;
use src\backoffice\Categories\Domain\CategoryId;
use src\backoffice\Products\Domain\ProductRepository;
use src\backoffice\Products\Domain\ValueObjects\ProductId;
use src\backoffice\Products\Domain\ValueObjects\ProductName;
use src\backoffice\Products\Domain\ValueObjects\ProductEnabled;
use src\backoffice\Products\Domain\ValueObjects\ProductUnitPrice;
use src\backoffice\Products\Domain\ValueObjects\ProductDescription;
use src\backoffice\Products\Domain\ValueObjects\ProductLowStockAlert;
use src\backoffice\Products\Domain\ValueObjects\ProductDescriptionShort;
use src\backoffice\Products\Domain\ValueObjects\ProductLowStockThreshold;
use src\backoffice\Products\Domain\Interfaces\IValidateLowStockThresholdQuantity;
use src\backoffice\Products\Domain\ValueObjects\ProductOutOfStock;

final class ProductUpdater
{
    public function __construct(
        private ProductRepository $repository,
        private IValidateLowStockThresholdQuantity $validateLowStockThresholdQuantityService,
    ) {
        $this->repository = $repository;
    }

    public function __invoke(
        ProductId $productId,
        ProductName $productName,
        ProductDescription $productDescription,
        ProductDescriptionShort $productDescriptionShort,
        ProductUnitPrice $productUnitPrice,
        CategoryId $categoryId,
        ProductLowStockAlert $lowStockAlert,
        ProductLowStockThreshold $lowStockThreshold,
        ProductOutOfStock $productOutOfStock,
        ProductEnabled $enabled
    ) {
        $this->validateOperation($lowStockThreshold);

        $product = Product::update(
            $productId,
            $productName,
            $productDescription,
            $productDescriptionShort,
            $productUnitPrice,
            $categoryId,
            $lowStockAlert,
            $lowStockThreshold,
            $productOutOfStock,
            $enabled
        );

        $this->repository->update($product);
    }

    private function validateOperation($lowStockThreshold): void
    {
        $this->validateLowStockThresholdQuantityService->validateLowStockThresholdQuantity($lowStockThreshold);    
    }
}
