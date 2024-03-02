<?php

declare(strict_types=1);

namespace src\backoffice\Stock\Application\Find;

use src\backoffice\Stock\Domain\StockNotExist;
use src\backoffice\Stock\Domain\Interfaces\IStockRepository;

final class GetStockListByProductId
{
    private $repository;

    public function __construct(IStockRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke($id): array
    {
        $stock = $this->repository->getStockListByProductId($id);

        if (null === $stock) {
            throw new StockNotExist($id);
        }

        return $stock;
    }
}
