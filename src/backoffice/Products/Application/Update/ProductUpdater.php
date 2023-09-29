<?php

declare(strict_types=1);

namespace src\backoffice\Products\Application\Update;

use src\backoffice\Products\Domain\Product;
use src\backoffice\Products\Domain\ProductId;
use src\backoffice\Products\Domain\ProductName;
use src\backoffice\Categories\Domain\CategoryId;
use src\backoffice\Products\Domain\ProductEnabled;
use src\backoffice\Products\Domain\ProductUnitPrice;
use src\backoffice\Products\Domain\ProductRepository;
use src\backoffice\Products\Domain\ProductDescription;
use src\backoffice\Products\Domain\ProductLowStockAlert;
use src\backoffice\Products\Domain\ProductMinimumQuantity;
use src\backoffice\Products\Domain\ProductDescriptionShort;
use src\backoffice\Products\Domain\ProductLowStockThreshold;

final class ProductUpdater
{
    public function __construct(private ProductRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(
                            ProductId $productId, 
                            ProductName $productName, 
                            ProductDescription $productDescription, 
                            ProductDescriptionShort $productDescriptionShort,
                            ProductUnitPrice $productUnitPrice, 
                            CategoryId $categoryId, 
                            ProductMinimumQuantity $minimum_quantity,
                            ProductLowStockThreshold $lowStockThreshold,
                            ProductLowStockAlert $lowStockAlert,
                            ProductEnabled $enabled
                        )
    {
        $product = Product::update(
                                    $productId, 
                                    $productName, 
                                    $productDescription, 
                                    $productDescriptionShort,
                                    $productUnitPrice, 
                                    $categoryId, 
                                    $minimum_quantity,
                                    $lowStockThreshold,
                                    $lowStockAlert,
                                    $enabled
                                );

        $this->repository->update($product);
    }
}
