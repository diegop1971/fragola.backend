<?php

declare(strict_types=1);

namespace src\backoffice\Products\Application\Delete;

use src\backoffice\Products\Domain\IProductRepository;

final class ProductDeleter
{

    public function __construct(private IProductRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $id)
    {
        $this->repository->delete($id);
    }
}
