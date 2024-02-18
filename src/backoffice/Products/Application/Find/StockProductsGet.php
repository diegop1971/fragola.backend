<?php

declare(strict_types=1);

namespace src\backoffice\Products\Application\Find;

use src\backoffice\Products\Domain\ProductRepository;

final class StockProductsGet
{
    private $repository;

    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(): array
    {
        $products = $this->repository->getAllEnabledProductNamesAndIDs();

        return $products;
    }
}
