<?php

namespace src\backoffice\Products\Domain;

interface IProductFinderCommand
{
    //public function productId(): string;

    public function productName(): string;

    public function productDescription(): string;

    public function productUnitPrice(): float;

    public function productCategoryId(): int;

    public function productCategoryName(): string;

    public function productEnabled(): int;

}