<?php

declare(strict_types=1);

namespace src\backoffice\Products\Application\Find;

use src\backoffice\Products\Domain\ProductNotExist;
use src\backoffice\Products\Domain\ProductRepository;

class ProductFinderWithCategory
{
    private $repository;

    public function __construct(ProductRepository $repository,)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $id): ?array
    {
        $product = $this->repository->getProductDetailsWithCategory($id);

        if (null === $product) {
            throw new ProductNotExist($id);
        }

        $productList = [
            'id' => $product['id'],
            'name' => $product['name'],
            'description' => $product['description'],
            'description_short' => $product['description_short'],
            'price' => $product['price'],
            'low_stock_alert' => $product['low_stock_alert'],
            'low_stock_threshold' => $product['low_stock_threshold'],
            'out_of_stock' => $product['out_of_stock'],
            'category_id' => $product['category_id'],
            'category_name' => $product['category_name'],
            'enabled' => $product['enabled'],
        ];

        return $productList;
    }
}
