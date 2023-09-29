<?php

declare(strict_types=1);

namespace src\backoffice\Stock\Application\Delete;

use src\backoffice\Stock\Domain\Interfaces\StockRepositoryInterface;

final class StockDeleter
{

    public function __construct(private StockRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $id)
    {
        $this->repository->delete($id);
    }
}
