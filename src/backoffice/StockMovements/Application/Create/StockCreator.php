<?php

declare(strict_types=1);

namespace src\backoffice\StockMovements\Application\Create;

use src\backoffice\Stock\Domain\Stock;
use src\backoffice\Stock\Domain\ValueObjects\StockId;
use src\backoffice\Stock\Domain\ValueObjects\StockDate;
use src\backoffice\Stock\Domain\ValueObjects\StockNotes;
use src\backoffice\Stock\Domain\ValueObjects\StockEnabled;
use src\backoffice\Stock\Domain\ValueObjects\StockQuantity;
use src\backoffice\Stock\Domain\ValueObjects\StockProductId;
use src\backoffice\Stock\Domain\ValueObjects\StockMovementTypeId;
use src\backoffice\Stock\Domain\Interfaces\StockRepositoryInterface;
use src\backoffice\StockMovementType\Domain\StockMovementTypeRepository;
use src\backoffice\Stock\Domain\Interfaces\StockAvailabilityServiceInterface;
use src\backoffice\Stock\Domain\Interfaces\StockMovementTypeCheckerServiceInterface;
use src\backoffice\Stock\Domain\Interfaces\StockQuantitySignHandlerServiceInterface;
use src\backoffice\Stock\Domain\Interfaces\StockValidateQuantityGreaterThanZeroServiceInterface;

final class StockCreator
{
    public function __construct(
                                private StockRepositoryInterface $stockRepository, 
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
                            StockMovementTypeId $stockMovementTypeId, 
                            StockQuantity $stockQuantity, 
                            StockDate $stockDate, 
                            StockNotes $stockNotes, 
                            StockEnabled $stockEnabled
                        )
    {
        $stockQuantity = $this->validateOperation($stockQuantity, $stockMovementTypeId, $stockProductId);

        $stock = Stock::create(
                                $stockId, 
                                $stockProductId, 
                                $stockMovementTypeId, 
                                $stockQuantity, 
                                $stockDate, 
                                $stockNotes, 
                                $stockEnabled,
                                $this->stockRepository,
                                $this->stockMovementTypeRepository,
                            );
                            
        $this->stockRepository->save($stock);
    }

    private function validateOperation($stockQuantity, $stockMovementTypeId, $stockProductId): StockQuantity
    {
        $this->stockValidateQuantityGreaterThanZeroService->validateQuantityGreaterThanZero($stockQuantity);

        $stockMovementType = $this->stockMovementTypeCheckerService->stockMovementType($this->stockMovementTypeRepository, $stockMovementTypeId);

        if($stockMovementType == false) {
            $this->stockAvailabilityService->makeStockOut($stockProductId, $stockQuantity, $stockMovementTypeId);
        }
        
        $stockQuantitySign = $this->stockQuantitySignHandlerService->setStockQuantitySign($stockMovementType, $stockQuantity);
        
        return $stockQuantitySign;
    }
}
