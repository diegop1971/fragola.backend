<?php

declare(strict_types=1);

namespace src\backoffice\Products\Application\Create;

use src\backoffice\Products\Domain\Product;
use src\backoffice\Categories\Domain\CategoryId;
use src\backoffice\Products\Domain\ProductRepository;
use src\backoffice\Products\Domain\ValueObjects\ProductId;
use src\backoffice\Products\Domain\ValueObjects\ProductName;
use src\backoffice\Products\Domain\ValueObjects\ProductEnabled;
use src\backoffice\Products\Domain\ValueObjects\ProductUnitPrice;
use src\backoffice\Products\Domain\ValueObjects\ProductDescription;
use src\backoffice\Products\Domain\ValueObjects\ProductLowStockAlert;
use src\backoffice\Products\Domain\ValueObjects\ProductMinimumQuantity;
use src\backoffice\Products\Domain\ValueObjects\ProductDescriptionShort;
use src\backoffice\Products\Domain\ValueObjects\ProductLowStockThreshold;
use src\backoffice\Products\Domain\Interfaces\IValidateLowStockThresholdQuantity;

final class ProductCreator
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
        ProductMinimumQuantity $minimum_quantity,
        ProductLowStockThreshold $lowStockThreshold,
        ProductEnabled $enabled
    ) {
        $this->validateOperation($lowStockThreshold, $minimum_quantity);
        
        $product = Product::create(
            $productId,
            $productName,
            $productDescription,
            $productDescriptionShort,
            $productUnitPrice,
            $categoryId,
            $lowStockAlert,
            $minimum_quantity,
            $lowStockThreshold,
            $enabled
        );

        $this->repository->save($product);
    }

    private function validateOperation($lowStockThreshold, $minimum_quantity): void
    {
        $this->validateLowStockThresholdQuantityService->validateLowStockThresholdQuantity($lowStockThreshold, $minimum_quantity);
    }
}
