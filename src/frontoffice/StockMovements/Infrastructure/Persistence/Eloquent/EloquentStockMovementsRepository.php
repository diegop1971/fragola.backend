<?php

declare(strict_types=1);

namespace src\frontoffice\StockMovements\Infrastructure\Persistence\Eloquent;

use src\frontoffice\Shared\Domain\Stock\StockNotExist;
use src\frontoffice\StockMovements\Domain\StockMovement;
use src\frontoffice\StockMovements\Domain\Interfaces\IStockMovementRepository;
use src\frontoffice\StockMovements\Infrastructure\Persistence\Eloquent\EloquentStockMovementModel;

class EloquentStockMovementsRepository implements IStockMovementRepository
{
    public function __construct()
    {
    }

    public function sumStockQuantityByProductId(string $productId): int
    {
        $sum = EloquentStockMovementModel::where('product_id', $productId)->sum('system_quantity');

        if (null === $sum) {
            throw new StockNotExist($productId);
        }

        return intval($sum);
    }

    public function insert(StockMovement $stockMovement): void
    {
        $model = new EloquentStockMovementModel();

        $model->id = $stockMovement->stockId()->value();
        $model->product_id = $stockMovement->stockProductId()->value();
        $model->movement_type_id = $stockMovement->stockMovementTypeId()->value();
        $model->system_quantity = $stockMovement->stockSystemStockQuantity()->value();
        $model->physical_quantity = $stockMovement->stockPhysicalStockQuantity()->value();
        $model->date = $stockMovement->stockDate()->value();
        $model->notes = $stockMovement->StockMovementsNotes()->value();
        $model->enabled = $stockMovement->stockEnabled()->value();

        $model->save();
    }
}
