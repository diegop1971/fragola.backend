<?php

declare(strict_types=1);

namespace src\frontoffice\Products\Application\Find;

use src\frontoffice\Products\Domain\ProductRepository;

final class GetEnabledProductsInActiveCategories
{
    public function __construct(private ProductRepository $productRepository) 
    {
    }

    public function __invoke(): array
    {
        $products = $this->productRepository->getEnabledProductsInActiveCategories();

        return $products;
    }
}