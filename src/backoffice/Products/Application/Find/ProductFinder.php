<?php

declare(strict_types=1);

namespace src\backoffice\Products\Application\Find;

use src\backoffice\Products\Domain\ProductNotExist;
use src\backoffice\Products\Domain\ProductRepository;
use src\backoffice\Products\Application\Find\ProductDTO;

final class ProductFinder
{
    private $repository;

    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $id): ?ProductDTO
    {
        $product = $this->repository->search($id);

        if (null === $product) {
            throw new ProductNotExist($id);
        }
        
        return $product;
    }
}
