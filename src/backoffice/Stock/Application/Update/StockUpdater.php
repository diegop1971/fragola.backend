<?php

declare(strict_types=1);

namespace src\backoffice\Stock\Application\Update;

use src\backoffice\Stock\Domain\Stock;
use src\backoffice\Shared\Domain\Stock\StockId;
use src\backoffice\Shared\Domain\Stock\StockProductId;
use src\backoffice\Stock\Domain\Interfaces\IStockRepository;
use src\backoffice\Shared\Domain\Stock\StockSystemStockQuantity;
use src\backoffice\Shared\Domain\Stock\StockPhysicalStockQuantity;
use src\backoffice\StockMovementType\Domain\StockMovementTypeRepository;

final class StockUpdater
{
    public function __construct(
        private IStockRepository $stockRepository,
        private StockMovementTypeRepository $stockMovementTypeRepository
    ) {
    }

    public function __invoke(

        StockId $stockId,
        StockProductId $stockProductId,
        StockPhysicalStockQuantity $stockPhysicalStockQuantity,
        StockSystemStockQuantity $stockSystemStockQuantity,
    ) {
        $stock = Stock::update(
            $stockId,
            $stockProductId,
            $stockPhysicalStockQuantity,
            $stockSystemStockQuantity,
            $this->stockRepository,
            $this->stockMovementTypeRepository,
        );

        $this->stockRepository->update($stock);
    }
}
