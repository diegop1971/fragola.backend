<?php

declare(strict_types=1);

namespace src\backoffice\StockMovements\Application\Create;

use Throwable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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
use src\backoffice\StockMovements\Domain\Interfaces\StockUpdaterServiceInterface;
use src\backoffice\StockMovements\Domain\Interfaces\StockAvailabilityServiceInterface;
use src\backoffice\StockMovements\Domain\Interfaces\StockMovementTypeCheckerServiceInterface;
use src\backoffice\StockMovements\Domain\Interfaces\StockQuantitySignHandlerServiceInterface;
use src\backoffice\StockMovements\Domain\Interfaces\StockValidateQuantityGreaterThanZeroServiceInterface;
use src\backoffice\Stock\Domain\ValueObjects\SystemStockQuantity;
use src\backoffice\Stock\Domain\ValueObjects\PhysicalStockQuantity;

final class StockMovementCreator
{
    private SystemStockQuantity $systemStockQuantity;
    private PhysicalStockQuantity $physicalStockQuantity;

    public function __construct(
        private IStockRepository $stockMovementsRepository,
        private StockMovementTypeRepository $stockMovementTypeRepository,
        private StockQuantitySignHandlerServiceInterface $stockQuantitySignHandlerService,
        private StockValidateQuantityGreaterThanZeroServiceInterface $stockValidateQuantityGreaterThanZeroService,
        private StockMovementTypeCheckerServiceInterface $stockMovementTypeCheckerService,
        private StockAvailabilityServiceInterface $stockAvailabilityService,
        private StockUpdaterServiceInterface $StockUpdaterService,
    ) {
    }

    public function __invoke(
        StockId $id,
        StockProductId $stockProductId,
        StockMovementTypeId $stockMovementTypeId,
        StockQuantity $stockQuantity,
        StockDate $stockDate,
        StockNotes $stockNotes,
        StockEnabled $stockEnabled
    ) {
        $stockQuantity = $this->validateOperation($stockQuantity, $stockMovementTypeId, $stockProductId);

        try {
            DB::beginTransaction();

            $this->systemStockQuantity = new SystemStockQuantity($stockQuantity->value());
            $this->physicalStockQuantity = new PhysicalStockQuantity($stockQuantity->value());

            $stock = StockMovements::create(
                $id,
                $stockProductId,
                $stockMovementTypeId,
                $this->systemStockQuantity,
                $this->physicalStockQuantity,
                $stockDate,
                $stockNotes,
                $stockEnabled,
            );

            $this->stockMovementsRepository->save($stock);

            $stockProductId = $stockProductId->value();
            $stockQuantity = $this->systemStockQuantity->value();

            $this->StockUpdaterService->updateStockFromMovement($stockProductId, $stockQuantity);

            DB::commit();
        } catch (Throwable $e) {
            DB::rollback();
            throw $e;
        }
    }

    private function validateOperation($stockQuantity, $stockMovementTypeId, $stockProductId): StockQuantity
    {
        $this->stockValidateQuantityGreaterThanZeroService->validateQuantityGreaterThanZero($stockQuantity);

        $stockMovementType = $this->stockMovementTypeCheckerService->stockMovementType($this->stockMovementTypeRepository, $stockMovementTypeId);
        
        $stockQuantitySigned = $this->stockQuantitySignHandlerService->setStockQuantitySign($stockMovementType, $stockQuantity);

        if ($stockMovementType === -1) {
            $this->stockAvailabilityService->makeStockOut($stockProductId, $stockQuantity, $stockMovementTypeId);
        }
        return $stockQuantitySigned;
    }
}
