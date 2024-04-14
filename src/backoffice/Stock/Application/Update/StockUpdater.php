<?php

declare(strict_types=1);

namespace src\backoffice\Stock\Application\Update;

use src\backoffice\Stock\Domain\Stock;
use src\backoffice\Stock\Domain\ValueObjects\StockId;
use src\backoffice\Stock\Domain\Interfaces\IStockRepository;
use src\backoffice\Stock\Domain\ValueObjects\StockProductId;
use src\backoffice\Stock\Domain\ValueObjects\SystemStockQuantity;
use src\backoffice\Stock\Domain\ValueObjects\PhysicalStockQuantity;
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
        PhysicalStockQuantity $physicalStockQuantity,
        SystemStockQuantity $systemStockQuantity,
    ) {
        $stock = Stock::update(
            $stockId,
            $stockProductId,
            $physicalStockQuantity,
            $systemStockQuantity,
            $this->stockRepository,
            $this->stockMovementTypeRepository,
        );

        $this->stockRepository->update($stock);
    }
}
