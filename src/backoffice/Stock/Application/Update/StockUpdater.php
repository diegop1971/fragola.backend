<?php

declare(strict_types=1);

namespace src\backoffice\Stock\Application\Update;

use src\backoffice\Stock\Domain\Stock;
use src\backoffice\Stock\Domain\ValueObjects\StockId;
use src\backoffice\Stock\Domain\ValueObjects\StockProductId;
use src\backoffice\Stock\Domain\ValueObjects\StockUsableQuantity;
use src\backoffice\Stock\Domain\ValueObjects\StockPhysicalQuantity;
use src\backoffice\Stock\Domain\Interfaces\StockRepositoryInterface;
use src\backoffice\StockMovementType\Domain\StockMovementTypeRepository;

final class StockUpdater
{
    public function __construct(
        private StockRepositoryInterface $stockRepository,
        private StockMovementTypeRepository $stockMovementTypeRepository
    ) {
    }

    public function __invoke(

        StockId $stockId,
        StockProductId $stockProductId,
        StockPhysicalQuantity $stockPhysicalQuantity,
        StockUsableQuantity $stockUsableQuantity,
    ) {
        $stock = Stock::update(
            $stockId,
            $stockProductId,
            $stockPhysicalQuantity,
            $stockUsableQuantity,
            $this->stockRepository,
            $this->stockMovementTypeRepository,
        );

        $this->stockRepository->update($stock);
    }
}
