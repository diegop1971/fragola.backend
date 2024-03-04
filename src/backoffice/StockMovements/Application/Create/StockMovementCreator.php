<?php

declare(strict_types=1);

namespace src\backoffice\StockMovements\Application\Create;

use Throwable;
use Illuminate\Support\Facades\DB;
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

final class StockMovementCreator
{
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

            $stock = StockMovements::create(
                $id,
                $stockProductId,
                $stockMovementTypeId,
                $stockQuantity,
                $stockDate,
                $stockNotes,
                $stockEnabled,
            );

            $this->stockMovementsRepository->save($stock);

            $stockProductId = $stockProductId->value();
            $stockQuantity = $stockQuantity->value();

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

        if ($stockMovementType == false) {
            $this->stockAvailabilityService->makeStockOut($stockProductId, $stockQuantity, $stockMovementTypeId);
        }

        $stockQuantitySigned = $this->stockQuantitySignHandlerService->setStockQuantitySign($stockMovementType, $stockQuantity);

        return $stockQuantitySigned;
    }
}
