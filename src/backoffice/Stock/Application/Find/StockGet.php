<?php

declare(strict_types=1);

namespace src\backoffice\Stock\Application\Find;

use src\backoffice\Stock\Domain\Interfaces\StockRepositoryInterface;

final class StockGet
{
    private $repository;

    public function __construct(StockRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(): array
    {
        $stocks = $this->repository->searchAll();

        return $stocks;
    }
}
