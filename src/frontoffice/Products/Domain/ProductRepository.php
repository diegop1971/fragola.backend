<?php

namespace src\frontoffice\Products\Domain;

use src\frontoffice\Products\Domain\Product;

interface ProductRepository
{
    public function getEnabledProductsInActiveCategories(): ?array;

    public function search($id): ?array;
}
