<?php

declare(strict_types=1);

namespace src\backoffice\StockMovements\Application\Find;

use src\backoffice\Stock\Domain\StockNotExist;
use src\backoffice\Stock\Domain\Interfaces\IStockRepository;

final class StockFinder
{
    private $stockRepository;

    public function __construct(IStockRepository $stockRepository)
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
