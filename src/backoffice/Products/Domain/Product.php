<?php

declare(strict_types=1);

namespace src\backoffice\Products\Domain;

use src\backoffice\Categories\Domain\CategoryId;
use src\backoffice\Products\Domain\ValueObjects\ProductId;
use src\backoffice\Products\Domain\ValueObjects\ProductName;
use src\backoffice\Products\Domain\ValueObjects\ProductEnabled;
use src\backoffice\Products\Domain\ValueObjects\ProductUnitPrice;
use src\backoffice\Products\Domain\ValueObjects\ProductOutOfStock;
use src\backoffice\Products\Domain\ValueObjects\ProductDescription;
use src\backoffice\Products\Domain\ValueObjects\ProductLowStockAlert;
use src\backoffice\Products\Domain\ValueObjects\ProductDescriptionShort;
use src\backoffice\Products\Domain\ValueObjects\ProductLowStockThreshold;

final class Product
{
    public function __construct(
        private ProductId $productId,
        private ProductName $productName,
        private ProductDescription $productDescription,
        private ProductDescriptionShort $productDescriptionShort,
        private ProductUnitPrice $productUnitPrice,
        private CategoryId $categoryId,
        private ProductLowStockAlert $lowStockAlert,
        private ProductLowStockThreshold $lowStockThreshold,
        private ProductOutOfStock $productOutOfStock,
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
        ProductLowStockAlert $lowStockAlert,
        ProductLowStockThreshold $lowStockThreshold,
        ProductOutOfStock $productOutOfStock,
        ProductEnabled $productEnabled
    ): self {
        $product = new self(
            $productId,
            $productName,
            $productDescription,
            $productDescriptionShort,
            $productUnitPrice,
            $categoryId,
            $lowStockAlert,
            $lowStockThreshold,
            $productOutOfStock,
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
        ProductLowStockAlert $lowStockAlert,
        ProductLowStockThreshold $lowStockThreshold,
        ProductOutOfStock $productOutOfStock,
        ProductEnabled $productEnabled
    ): self {
        $product = new self(
            $productId,
            $productName,
            $productDescription,
            $productDescriptionShort,
            $productUnitPrice,
            $categoryId,
            $lowStockAlert,
            $lowStockThreshold,
            $productOutOfStock,
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

    public function productLowStockAlert(): ProductLowStockAlert
    {
        return $this->lowStockAlert;
    }

    public function productOutOfStock(): ProductOutOfStock
    {
        return $this->productOutOfStock;
    }

    public function productLowStockThreshold(): ProductLowStockThreshold
    {
        return $this->lowStockThreshold;
    }
}
