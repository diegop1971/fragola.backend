<?php

declare(strict_types=1);

namespace src\backoffice\StockMovements\Application\Delete;

use src\backoffice\Stock\Domain\Interfaces\IStockRepository;

final class StockDeleter
{

    public function __construct(private IStockRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $id)
    {
        $this->repository->delete($id);
    }
}
