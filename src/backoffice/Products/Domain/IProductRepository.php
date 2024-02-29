<?php

namespace src\backoffice\Products\Domain;

use src\backoffice\Products\Domain\Product;

interface IProductRepository
{
    public function searchAll(): ?array;

    public function getAllEnabledProductNamesAndIDs(): ?array;

    public function search($id): ?array;

    public function getProductDetailsWithCategory($id): ?array;

    public function save(Product $product): void;

    public function update(Product $product): void;
    
    public function delete($id): void;
}
