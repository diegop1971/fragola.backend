<?php

declare(strict_types=1);

namespace src\backoffice\Products\Application\Create;

use src\Shared\Domain\Bus\Command\Command;

final class CreateProductCommand implements Command
{
    public function __construct(
        private string $id,
        private string $name,
        private string $description,
        private string $descriptionShort,
        private float $unitPrice,
        private string $categoryId,
        private bool $lowStockAlert,
        private int $minimumQuantity,
        private int $lowStockThreshold,
        private bool $enabled
    ) {
    }

    public function productId(): string
    {
        return $this->id;
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

    public function productMinimumQuantity(): int
    {
        return intval($this->minimumQuantity);
    }

    public function productLowStockThreshold(): int
    {
        return intval($this->lowStockThreshold);
    }

    public function productLowStockAlert(): bool
    {
        return boolval($this->lowStockAlert);
    }

    public function enabled(): bool
    {
        return boolval($this->enabled);
    }
}
