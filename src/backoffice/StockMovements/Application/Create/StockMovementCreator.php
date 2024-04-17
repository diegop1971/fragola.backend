<?php

declare(strict_types=1);

namespace src\backoffice\StockMovements\Application\Create;

use Throwable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use src\backoffice\Shared\Domain\Stock\StockId;
use src\backoffice\Shared\Domain\Stock\StockQuantity;
use src\backoffice\Shared\Domain\Stock\StockProductId;
use src\backoffice\StockMovements\Domain\StockMovements;
use src\backoffice\Shared\Domain\Stock\StockSystemStockQuantity;
use src\backoffice\Shared\Domain\Stock\StockPhysicalStockQuantity;
use src\backoffice\Shared\Domain\StockMovementType\StockMovementTypeId;
use src\backoffice\StockMovements\Domain\ValueObjects\StockMovementsDate;
use src\backoffice\StockMovementType\Domain\IStockMovementTypeRepository;
use src\backoffice\StockMovements\Domain\ValueObjects\StockMovementsNotes;
use src\backoffice\StockMovements\Domain\ValueObjects\StockMovementsEnabled;
use src\backoffice\StockMovements\Domain\Interfaces\IStockMovementsRepository;
use src\backoffice\StockMovements\Domain\Interfaces\StockUpdaterServiceInterface;
use src\backoffice\StockMovements\Domain\Interfaces\IStockMovementTypeFetcherService;
use src\backoffice\StockMovements\Domain\Interfaces\StockAvailabilityServiceInterface;
use src\backoffice\StockMovements\Domain\Interfaces\IStockQuantityImpactHandlerService;
use src\backoffice\StockMovements\Domain\Interfaces\StockValidateQuantityGreaterThanZeroServiceInterface;

final class StockMovementCreator
{
    private StockSystemStockQuantity $systemStockQuantity;
    private StockPhysicalStockQuantity $physicalStockQuantity;

    public function __construct(
        private IStockMovementsRepository $stockMovementsRepository,
        private IStockMovementTypeRepository $stockMovementTypeRepository,
        private IStockQuantityImpactHandlerService $stockQuantityImpactHandlerService,
        private StockValidateQuantityGreaterThanZeroServiceInterface $stockValidateQuantityGreaterThanZeroService,
        private IStockMovementTypeFetcherService $StockMovementTypeFetcherService,
        private StockAvailabilityServiceInterface $stockAvailabilityService,
        private StockUpdaterServiceInterface $StockUpdaterService,
    ) {
    }

    public function __invoke(
        StockId $id,
        StockProductId $stockProductId,
        StockMovementTypeId $stockMovementTypeId,
        StockQuantity $stockQuantity,
        StockMovementsDate $stockMovementsDate,
        StockMovementsNotes $stockMovementsNotes,
        StockMovementsEnabled $stockMovementsEnabled
    ) {
        try {
            DB::beginTransaction();

            $this->validateOperation($stockQuantity, $stockMovementTypeId, $stockProductId);

            $stockMovement = StockMovements::create(
                $id,
                $stockProductId,
                $stockMovementTypeId,
                $this->systemStockQuantity,
                $this->physicalStockQuantity,
                $stockMovementsDate,
                $stockMovementsNotes,
                $stockMovementsEnabled,
            );

            $this->stockMovementsRepository->save($stockMovement);

            $stockProductId = $stockProductId->value();
            $stockQuantity = $this->systemStockQuantity->value();

            $this->StockUpdaterService->updateStockFromMovement($stockProductId, $this->systemStockQuantity, $this->physicalStockQuantity);

            DB::commit();
        } catch (Throwable $e) {
            DB::rollback();
            throw $e;
        }
    }

    private function validateOperation(StockQuantity $stockQuantity, $stockMovementTypeId, $stockProductId): void  //: StockQuantity
    {
        $this->stockValidateQuantityGreaterThanZeroService->validateQuantityGreaterThanZero($stockQuantity);

        $this->systemStockQuantity = new StockSystemStockQuantity($stockQuantity->value());
            $this->physicalStockQuantity = new StockPhysicalStockQuantity($stockQuantity->value());
            
            $stockMovementType = $this->StockMovementTypeFetcherService->stockMovementType($stockMovementTypeId);
            $isPositiveSystem = $stockMovementType['is_positive_system'];
            $isPositivePhysical = $stockMovementType['is_positive_physical'];

            $systemStockQuantity = $this->stockQuantityImpactHandlerService->setStockQuantitySign($isPositiveSystem, $stockQuantity);
            $physicalStockQuantity = $this->stockQuantityImpactHandlerService->setStockQuantitySign($isPositivePhysical, $stockQuantity);

            $this->systemStockQuantity = new StockSystemStockQuantity($systemStockQuantity->value());
            $this->physicalStockQuantity = new StockPhysicalStockQuantity($physicalStockQuantity->value());

        if ($isPositiveSystem === -1) {
            $this->stockAvailabilityService->makeStockOut($stockProductId, $stockQuantity, $isPositiveSystem);
        }
        
        if ($isPositivePhysical === -1) {
            $this->stockAvailabilityService->makeStockOut($stockProductId, $stockQuantity, $isPositiveSystem);
        }
    }
}
