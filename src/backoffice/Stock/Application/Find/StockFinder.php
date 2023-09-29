<?php

declare(strict_types=1);

namespace src\backoffice\Stock\Application\Find;

use src\backoffice\Stock\Domain\StockNotExist;
use src\backoffice\Stock\Domain\Interfaces\StockRepositoryInterface;

final class StockFinder
{
    private $stockRepository;

    public function __construct(StockRepositoryInterface $stockRepository)
    {
        $this->stockRepository = $stockRepository;
    }

    public function __invoke(string $id): ?array
    {
        $stockMovement = $this->stockRepository->search($id);
        
        if (null === $stockMovement) {
            throw new StockNotExist($id);
        }
        
        return $stockMovement;
    }
}
