<?php

declare(strict_types=1);

namespace src\backoffice\StockMovements\Infrastructure\Persistence\Eloquent;

use src\backoffice\StockMovements\Domain\StockNotExist;
use src\backoffice\StockMovements\Domain\StockMovements;
use src\backoffice\StockMovements\Domain\Interfaces\IStockMovementsRepository;
use src\backoffice\StockMovements\Infrastructure\Persistence\Eloquent\EloquentStockMovementsModel;

class EloquentStockMovementsRepository implements IStockMovementsRepository
{
    public function __construct()
    {
    }

    public function getStockListByProductId($productId): ?array
    {
        $stock = EloquentStockMovementsModel::leftJoin('products', 'stock_movements.product_id', '=', 'products.id')
            ->leftJoin('stock_movement_types', 'stock_movements.movement_type_id', '=', 'stock_movement_types.id')
            ->select(
                'stock_movements.id',
                'stock_movements.product_id',
                'stock_movements.movement_type_id',
                'stock_movements.system_quantity',
                'stock_movements.physical_quantity',
                'stock_movements.date',
                'stock_movements.notes',
                'stock_movements.created_at',
                'stock_movement_types.movement_type'
            )
            ->where('stock_movements.product_id', $productId)
            ->orderByDesc('created_at')
            ->get();

        if ($stock->isEmpty()) {
            return null;
        }
        return $stock->toArray();
    }

    public function save(StockMovements $stock): void
    {
        $model = new EloquentStockMovementsModel();

        $model->id = $stock->stockId()->value();
        $model->product_id = $stock->stockProductId()->value();
        $model->movement_type_id = $stock->stockMovementTypeId()->value();
        $model->system_quantity = $stock->stockSystemStockQuantity()->value();
        $model->physical_quantity = $stock->stockPhysicalStockQuantity()->value();
        $model->date = $stock->stockMovementsDate()->value();
        $model->notes = $stock->stockMovementsNotes()->value();
        $model->enabled = $stock->stockMovementsEnabled()->value();

        $model->save();
    }

    public function sumStockQuantityByProductId(string $productId): int
    {
        $sum = EloquentStockMovementsModel::where('product_id', $productId)->sum('system_quantity');

        if (null === $sum) {
            throw new StockNotExist($productId);
        }

        return intval($sum);
    }
}
