<?php

declare(strict_types=1);

namespace src\backoffice\Products\Application\Create;

use src\Shared\Domain\Bus\Command\Command;

final class CreateProductCommand implements Command
{
    public function __construct(
        private string $productId,
        private string $name,
        private string $description,
        private string $descriptionShort,
        private float $unitPrice,
        private string $categoryId,
        private bool $lowStockAlert,
        private int $lowStockThreshold,
        private bool $outOfStock,
        private bool $enabled,
        private string $stockId,
        private int $stockPhysicalStockQuantity,
        private int $stockSystemStockQuantity,
    ) {
    }

    public function productId(): string
    {
        return $this->productId;
    }

    public function productName(): string
    {
        return $this->name;
    }

    public function productDescription(): string
    {
        return $this->description;
    }

    public function productDescriptionShort(): string
    {
        return $this->descriptionShort;
    }

    public function productUnitPrice(): float
    {
        return floatval($this->unitPrice);
    }

    public function categoryId(): string
    {
        return $this->categoryId;
    }

    public function productLowStockAlert(): bool
    {
        return boolval($this->lowStockAlert);
    }

    public function productLowStockThreshold(): int
    {
        return intval($this->lowStockThreshold);
    }

    public function productOutOfStock(): bool
    {
        return boolval($this->outOfStock);
    }

    public function enabled(): bool
    {
        return boolval($this->enabled);
    }

    public function stockId(): string
    {
        return $this->stockId;
    }

    public function stockPhysicalStockQuantity(): int
    {
        return intval($this->stockPhysicalStockQuantity);
    }

    public function stockSystemStockQuantity(): int
    {
        return intval($this->stockSystemStockQuantity);
    }
}
