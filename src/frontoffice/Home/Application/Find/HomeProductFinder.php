<?php

declare(strict_types=1);

namespace src\frontoffice\Home\Application\Find;

use src\frontoffice\Products\Domain\ProductNotExist;
use src\frontoffice\Home\Domain\Interfaces\HomeProductsRepositoryInterface;

final class HomeProductFinder
{
    private $repository;

    public function __construct(HomeProductsRepositoryInterface $repository)
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
