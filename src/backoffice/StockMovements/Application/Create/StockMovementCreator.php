<?php

declare(strict_types=1);

namespace src\backoffice\StockMovements\Application\Create;

use src\backoffice\StockMovements\Domain\StockMovements;
use src\backoffice\StockMovements\Domain\ValueObjects\StockId;
use src\backoffice\StockMovements\Domain\ValueObjects\StockDate;
use src\backoffice\StockMovements\Domain\ValueObjects\StockNotes;
use src\backoffice\StockMovements\Domain\ValueObjects\StockEnabled;
use src\backoffice\StockMovements\Domain\ValueObjects\StockQuantity;
use src\backoffice\StockMovements\Domain\Interfaces\IStockRepository;
use src\backoffice\StockMovements\Domain\ValueObjects\StockProductId;
use src\backoffice\StockMovementType\Domain\StockMovementTypeRepository;
use src\backoffice\StockMovements\Domain\ValueObjects\StockMovementTypeId;
use src\backoffice\StockMovements\Domain\Interfaces\StockAvailabilityServiceInterface;

use src\backoffice\StockMovements\Domain\Interfaces\StockValidateQuantityGreaterThanZeroServiceInterface;
use src\backoffice\StockMovements\Domain\Interfaces\StockMovementTypeCheckerServiceInterface;
use src\backoffice\StockMovements\Domain\Interfaces\StockQuantitySignHandlerServiceInterface;

final class StockMovementCreator
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
                            StockMovementTypeId $stockMovementTypeId, 
                            StockQuantity $stockQuantity, 
                            StockDate $stockDate, 
                            StockNotes $stockNotes, 
                            StockEnabled $stockEnabled
                        )
    {
        $stockQuantity = $this->validateOperation($stockQuantity, $stockMovementTypeId, $stockProductId);

        $stock = StockMovements::create(
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
