<?php

declare(strict_types=1);

namespace src\backoffice\StockMovementType\Application\Find;

use src\backoffice\Stock\Domain\StockNotExist;
use src\backoffice\Stock\Domain\Interfaces\StockRepositoryInterface;

final class StockMovementTypeFinder
{
    private $repository;

    public function __construct(StockRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $id): ?array
    {
        $stock = $this->repository->search($id);

        if (null === $stock) {
            throw new StockNotExist($id);
        }
        
        return $stock;
    }
}
