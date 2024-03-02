<?php

declare(strict_types=1);

namespace src\backoffice\Stock\Application\Find;

use src\backoffice\Stock\Domain\Interfaces\IStockRepository;

final class GetStockGroupedByProductId
{
    private $repository;

    public function __construct(IStockRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(): array
    {
        $stocks = $this->repository->getStockGroupedByProductId();

        return $stocks;
    }
}
