<?php

namespace src\backoffice\Products\Domain;

use src\backoffice\Products\Domain\Product;

interface ProductRepository
{
    public function searchAll(): ?array;

    public function search($id): ?IProductFinderCommand;

    public function save(Product $product): void;

    public function update(Product $product): void;
    
    public function delete($id): void;
}
