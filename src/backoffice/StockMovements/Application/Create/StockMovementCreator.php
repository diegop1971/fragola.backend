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
use src\backoffice\StockMovements\Domain\Interfaces\StockQuantitySignHandlerServiceInterface;
use src\backoffice\StockMovements\Domain\Interfaces\StockValidateQuantityGreaterThanZeroServiceInterface;

final class StockMovementCreator
{
    private StockSystemStockQuantity $stockSystemStockQuantity;
    private StockPhysicalStockQuantity $stockPhysicalStockQuantity;

    public function __construct(
        private IStockMovementsRepository $stockMovementsRepository,
        private IStockMovementTypeRepository $stockMovementTypeRepository,
        private StockQuantitySignHandlerServiceInterface $stockQuantitySignHandlerService,
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
        $stockQuantity = $this->validateOperation($stockQuantity, $stockMovementTypeId, $stockProductId);

        try {
            DB::beginTransaction();

            $this->stockSystemStockQuantity = new StockSystemStockQuantity($stockQuantity->value());
            $this->stockPhysicalStockQuantity = new StockPhysicalStockQuantity($stockQuantity->value());

            $stock = StockMovements::create(
                $id,
                $stockProductId,
                $stockMovementTypeId,
                $this->stockSystemStockQuantity,
                $this->stockPhysicalStockQuantity,
                $stockMovementsDate,
                $stockMovementsNotes,
                $stockMovementsEnabled,
            );

            //$this->stockMovementsRepository->save($stock);

            $stockProductId = $stockProductId->value();
            $stockQuantity = $this->stockSystemStockQuantity->value();

            //$this->StockUpdaterService->updateStockFromMovement($stockProductId, $stockQuantity);

            DB::commit();
        } catch (Throwable $e) {
            DB::rollback();
            throw $e;
        }
    }

    private function validateOperation(StockQuantity $stockQuantity, $stockMovementTypeId, $stockProductId): StockQuantity
    {
        $this->stockValidateQuantityGreaterThanZeroService->validateQuantityGreaterThanZero($stockQuantity);
        
        $stockMovementType = $this->StockMovementTypeFetcherService->stockMovementType($stockMovementTypeId);

        $isPositiveSystem = $stockMovementType['is_positive_system'];
        $isPositivePhysical = $stockMovementType['is_positive_physical'];

        Log::info($this->peperoni($isPositiveSystem, $stockQuantity));
        Log::info($this->peperoni($isPositivePhysical, $stockQuantity));

        $stockQuantitySigned = $this->stockQuantitySignHandlerService->setStockQuantitySign($isPositiveSystem, $stockQuantity);

        if ($isPositiveSystem === -1) {
            $this->stockAvailabilityService->makeStockOut($stockProductId, $stockQuantity, $isPositiveSystem);
        }
        return $stockQuantitySigned;
    }

    private function peperoni($isPositive, $stockQuantity)
    {
        $peperonildo = $this->stockQuantitySignHandlerService->setStockQuantitySign($isPositive, $stockQuantity);

        return $peperonildo->value();
    }
}
