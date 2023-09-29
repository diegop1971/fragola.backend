<?php

declare(strict_types=1);

namespace src\backoffice\Products\Application\Find;

use src\backoffice\Products\Domain\ProductNotExist;
use src\backoffice\Products\Domain\ProductRepository;

final class ProductFinder
{
    private $repository;

    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $id): ?array
    {
        $product = $this->repository->search($id);

        if (null === $product) {
            throw new ProductNotExist($id);
        }
        
        return $product;
    }
}
