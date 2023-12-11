<?php

declare(strict_types=1);

namespace src\backoffice\Products\Application\Find;

use src\backoffice\Products\Domain\IProductFinderCommand;

class ProductFinderCommand implements IProductFinderCommand
{   
    public function __construct(
        private string $id, 
        private string $name, 
        private string $description, 
        private float $price, 
        private int $categoryId, 
        private string $categoryName, 
        private int $enabled
        )
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->categoryId = $categoryId;
        $this->categoryName = $categoryName;
        $this->enabled = $enabled;
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

    public function productUnitPrice(): float
    {
        return floatval($this->price);
    }

    public function productCategoryId(): int
    {
        return intval($this->categoryId);
    }

    public function productCategoryName(): string
    {
        return $this->categoryName;
    }

    public function productEnabled(): int
    {
        return intval($this->enabled);
    }

}
