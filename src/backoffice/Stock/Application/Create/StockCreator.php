<?php

declare(strict_types=1);

namespace src\backoffice\Stock\Application\Create;

use src\backoffice\Stock\Domain\Stock;
use src\backoffice\Shared\Domain\Stock\StockId;
use src\backoffice\Shared\Domain\Stock\StockProductId;
use src\backoffice\Stock\Domain\Interfaces\IStockRepository;
use src\backoffice\Shared\Domain\Stock\StockSystemStockQuantity;
use src\backoffice\Shared\Domain\Stock\StockPhysicalStockQuantity;
use src\backoffice\StockMovementType\Domain\StockMovementTypeRepository;
use src\backoffice\Stock\Domain\Interfaces\StockAvailabilityServiceInterface;
use src\backoffice\Stock\Domain\Interfaces\StockMovementTypeCheckerServiceInterface;
use src\backoffice\Stock\Domain\Interfaces\StockQuantitySignHandlerServiceInterface;
use src\backoffice\Stock\Domain\Interfaces\StockValidateQuantityGreaterThanZeroServiceInterface;

final class StockCreator
{
    public function __construct(
        private IStockRepository $stockRepository,
        private StockMovementTypeRepository $stockMovementTypeRepository,
        private StockQuantitySignHandlerServiceInterface $stockQuantitySignHandlerService,
        private StockValidateQuantityGreaterThanZeroServiceInterface $stockValidateQuantityGreaterThanZeroService,
        private StockMovementTypeCheckerServiceInterface $stockMovementTypeCheckerService,
        private StockAvailabilityServiceInterface $stockAvailabilityService,
    ) {
    }

    public function __invoke(
        StockId $stockId,
        StockProductId $stockProductId,
        StockPhysicalStockQuantity $stockPhysicalStockQuantity,
        StockSystemStockQuantity $stockSystemStockQuantity,
    ) {

        $stock = Stock::create(
            $stockId,
            $stockProductId,
            $stockPhysicalStockQuantity,
            $stockSystemStockQuantity,
            $this->stockRepository,
            $this->stockMovementTypeRepository,
        );

        $this->stockRepository->save($stock);
    }
}
