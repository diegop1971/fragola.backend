<?php

declare(strict_types=1);

namespace src\backoffice\Products\Domain;

use src\backoffice\Products\Domain\ProductId;
use src\backoffice\Products\Domain\ProductName;
use src\backoffice\Categories\Domain\CategoryId;
use src\backoffice\Products\Domain\ProductEnabled;
use src\backoffice\Products\Domain\ProductUnitPrice;
use src\backoffice\Products\Domain\ProductDescription;
use src\backoffice\Products\Domain\ProductMinimumQuantity;
use src\backoffice\Products\Domain\ProductDescriptionShort;
use src\backoffice\Products\Domain\ProductLowStockThreshold;

final class Product
{
    public function __construct(
        private ProductId $productId, 
        private ProductName $productName, 
        private ProductDescription $productDescription, 
        private ProductDescriptionShort $productDescriptionShort,
        private ProductUnitPrice $productUnitPrice, 
        private CategoryId $categoryId, 
        private ProductMinimumQuantity $minimumQuantity,
        private ProductLowStockThreshold $lowStockThreshold,
        private ProductLowStockAlert $lowStockAlert,
        private ProductEnabled $productEnabled
    ) {
    }

    public static function create(
                                ProductId $productId, 
                                ProductName $productName, 
                                ProductDescription $productDescription, 
                                ProductDescriptionShort $productDescriptionShort,
                                ProductUnitPrice $productUnitPrice, 
                                CategoryId $categoryId, 
                                ProductMinimumQuantity $minimumQuantity,
                                ProductLowStockThreshold $lowStockThreshold,
                                ProductLowStockAlert $lowStockAlert,
                                ProductEnabled $productEnabled
                            ): self
    {
        $product = new self(
                            $productId, 
                            $productName, 
                            $productDescription, 
                            $productDescriptionShort, 
                            $productUnitPrice, 
                            $categoryId, 
                            $minimumQuantity,
                            $lowStockThreshold,
                            $lowStockAlert, 
                            $productEnabled
                        );
                        
        return $product;
    }

    public static function update(
                                ProductId $productId, 
                                ProductName $productName, 
                                ProductDescription $productDescription, 
                                ProductDescriptionShort $productDescriptionShort,
                                ProductUnitPrice $productUnitPrice, 
                                CategoryId $categoryId, 
                                ProductMinimumQuantity $minimumQuantity,
                                ProductLowStockThreshold $lowStockThreshold,
                                ProductLowStockAlert $lowStockAlert,
                                ProductEnabled $productEnabled
                            ): self
    {
        $product = new self(
                            $productId, 
                            $productName, 
                            $productDescription, 
                            $productDescriptionShort, 
                            $productUnitPrice, 
                            $categoryId, 
                            $minimumQuantity,
                            $lowStockThreshold,
                            $lowStockAlert, 
                            $productEnabled
                        );

        return $product;
    }

    public function productId(): ProductId
    {
        return $this->productId;
    }

    public function productName(): ProductName
    {
        return $this->productName;
    }

    public function productDescription(): ProductDescription
    {
        return $this->productDescription;
    }

    public function productDescriptionShort(): ProductDescriptionShort
    {
        return $this->productDescriptionShort;
    }

    public function productUnitPrice(): ProductUnitPrice
    {
        return $this->productUnitPrice;
    }

    public function categoryId(): CategoryId
    {
        return $this->categoryId;
    }

    public function productEnabled(): ProductEnabled
    {
        return $this->productEnabled;
    }
}
