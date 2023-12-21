<?php

declare(strict_types=1);

namespace src\backoffice\Products\Application\Find;

use src\backoffice\Products\Domain\ProductNotExist;
use src\backoffice\Products\Domain\ProductRepository;

final class ProductFinder
{
    private $repository;

    public function __construct(ProductRepository $repository, )
    {
        $this->repository = $repository;
    }

    public function __invoke(string $id): ?array
    {
        $product = $this->repository->search($id);

        $productList = [
            'id' => $product['id'],
            'name' => $product['name'],
            'description' => $product['description'],
            'price' => $product['price'],
            'category_id' => $product['category_id'],
            'category_name' => $product['category_name'],
            'enabled' => $product['enabled'],
        ];

        if (null === $productList) {
            throw new ProductNotExist($id);
        }
        
        return $productList;
    }
}
