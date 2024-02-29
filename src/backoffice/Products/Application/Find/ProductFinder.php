<?php

declare(strict_types=1);

namespace src\backoffice\Products\Application\Find;

use src\backoffice\Products\Domain\ProductNotExist;
use src\backoffice\Products\Domain\IProductRepository;

class ProductFinder
{
    private $repository;

    public function __construct(IProductRepository $repository,)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $id): ?array
    {
        $product = $this->repository->search($id);

        if (null === $product) {
            throw new ProductNotExist($id);
        }

        $productList = [
            'id' => $product['id'],
            'category_id' => $product['category_id'],
            'name' => $product['name'],
            'description' => $product['description'],
            'description_short' => $product['description_short'],
            'price' => $product['price'],
            'low_stock_threshold' => $product['low_stock_threshold'],
            'low_stock_alert' => $product['low_stock_alert'],
            'out_of_stock' => $product['out_of_stock'],
            'enabled' => $product['enabled'],
        ];

        return $productList;
    }
}
