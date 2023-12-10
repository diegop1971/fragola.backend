<?php

namespace src\backoffice\Products\Domain;

use src\backoffice\Products\Domain\Product;
use src\backoffice\Products\Application\Find\ProductDTO;

interface ProductRepository
{
    public function searchAll(): ?array;

    public function search($id): ?ProductDTO;

    public function save(Product $product): void;

    public function update(Product $product): void;
    
    public function delete($id): void;
}
