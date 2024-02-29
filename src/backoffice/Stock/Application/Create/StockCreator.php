<?php

declare(strict_types=1);

namespace src\backoffice\Stock\Application\Create;

use src\backoffice\Stock\Domain\Stock;
use src\backoffice\Stock\Domain\ValueObjects\StockId;
use src\backoffice\Stock\Domain\Interfaces\IStockRepository;
use src\backoffice\Stock\Domain\ValueObjects\StockProductId;
use src\backoffice\Stock\Domain\ValueObjects\StockUsableQuantity;
use src\backoffice\Stock\Domain\ValueObjects\StockPhysicalQuantity;
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
        StockPhysicalQuantity $stockPhysicalQuantity,
        StockUsableQuantity $stockUsableQuantity,
    ) {
        //$stockQuantity = $this->validateOperation($stockQuantity, $stockMovementTypeId, $stockProductId);

        $stock = Stock::create(
            $stockId,
            $stockProductId,
            $stockPhysicalQuantity,
            $stockUsableQuantity,
            $this->stockRepository,
            $this->stockMovementTypeRepository,
        );

        $this->stockRepository->save($stock);
    }

    /*private function validateOperation($stockQuantity, $stockMovementTypeId, $stockProductId): StockQuantity
    {
        $this->stockValidateQuantityGreaterThanZeroService->validateQuantityGreaterThanZero($stockQuantity);

        $stockMovementType = $this->stockMovementTypeCheckerService->stockMovementType($this->stockMovementTypeRepository, $stockMovementTypeId);

        if ($stockMovementType == false) {
            $this->stockAvailabilityService->makeStockOut($stockProductId, $stockQuantity, $stockMovementTypeId);
        }

        $stockQuantitySign = $this->stockQuantitySignHandlerService->setStockQuantitySign($stockMovementType, $stockQuantity);

        return $stockQuantitySign;
    }*/
}
