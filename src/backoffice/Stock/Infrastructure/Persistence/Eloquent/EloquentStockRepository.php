<?php

declare(strict_types=1);

namespace src\backoffice\Stock\Infrastructure\Persistence\Eloquent;

use Illuminate\Support\Facades\DB;
use src\backoffice\Stock\Domain\Stock;
use src\backoffice\Stock\Domain\StockNotExist;
use src\backoffice\Stock\Domain\Interfaces\IStockRepository;
use src\backoffice\Stock\Infrastructure\Persistence\Eloquent\EloquentStockModel;

class EloquentStockRepository implements IStockRepository
{

    public function __construct()
    {
    }

    public function searchAll(): ?array
    {
        $stocks = EloquentStockModel::leftJoin('products', 'stock_movements.product_id', '=', 'products.id')
            ->leftJoin('stock_movement_types', 'stock_movements.movement_type_id', '=', 'stock_movement_types.id')
            ->select('stock_movements.*', 'stock_movement_types.movement_type', 'products.name as product_name')
            ->get();

        if ($stocks->isEmpty()) {
            return [];
        }

        return $stocks->toArray();
    }

    public function search($productId): ?array
    {
        $stock = EloquentStockModel::leftJoin('products', 'stock_movements.product_id', '=', 'products.id')
            ->leftJoin('stock_movement_types', 'stock_movements.movement_type_id', '=', 'stock_movement_types.id')
            ->select('stock_movements.*', 'stock_movement_types.movement_type', 'products.name as product_name')
            ->where('stock_movements.product_id', $productId)
            ->first();

        if (null === $stock) {
            return null;
        }

        return $stock->toArray();
    }

    public function getStockListByProductId($productId): ?array
    {
        $stock = EloquentStockModel::leftJoin('products', 'stock_movements.product_id', '=', 'products.id')
            ->leftJoin('stock_movement_types', 'stock_movements.movement_type_id', '=', 'stock_movement_types.id')
            ->select(
                'stock_movements.id',
                'stock_movements.product_id',
                'stock_movements.movement_type_id',
                'stock_movements.quantity',
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

    public function getStockGroupedByProductId(): ?array
    {
        $stock = EloquentStockModel::leftJoin('products', 'stock.product_id', '=', 'products.id')
            ->selectRaw('products.id, products.name as product_name, 
            SUM(stock.physical_quantity) as physical_quantity, SUM(stock.usable_quantity) as usable_quantity, 
            low_stock_threshold, low_stock_alert, products.out_of_stock, products.enabled')
            ->groupBy('product_id')
            ->get();

        if ($stock->isEmpty()) {
            return [];
        }

        return $stock->toArray();
    }

    public function save(Stock $stock): void
    {
        $model = new EloquentStockModel();

        $model->id = $stock->stockId()->value();
        $model->product_id = $stock->stockProductId()->value();
        $model->physical_quantity = $stock->stockPhysicalQuantity()->value();
        $model->usable_quantity = $stock->stockUsableQuantity()->value();
        $model->save();
    }

    public function update(Stock $stock): void
    {
        $model = EloquentStockModel::find($stock->stockId()->value());

        $model->id = $stock->stockId()->value();
        $model->product_id = $stock->stockProductId()->value();
        $model->physical_quantity = $stock->stockPhysicalQuantity()->value();
        $model->usable_quantity = $stock->stockUsableQuantity()->value();

        $model->update();
    }

    public function updateQuantities(Stock $stock): void
    {
        $model = EloquentStockModel::where('product_id', $stock->stockProductId()->value())->first();

        if (!$model) {
            //throw new StockNotExist($id);
        }

        $model->physical_quantity = $stock->stockPhysicalQuantity()->value();
        $model->usable_quantity = $stock->stockUsableQuantity()->value();

        $model->update();
    }

    public function delete($id): void
    {
        $model = EloquentStockModel::find($id);

        if (null === $model) {
            throw new StockNotExist($id);
        }

        $model->delete();
    }

    public function getStockByProductId(string $productId): ?array
    {
        $models = EloquentStockModel::where('product_id', $productId)->get();

        if (null === $models) {
            throw new StockNotExist($productId);
        }

        return $models->toArray();
    }

    public function sumStockQuantityByProductId(string $productId): int
    {
        $sum = EloquentStockModel::where('product_id', $productId)->sum('quantity');

        if (null === $sum) {
            throw new StockNotExist($productId);
        }

        return intval($sum);
    }

    public function countStockByProductId(string $productId): ?int
    {
        $count = EloquentStockModel::where('product_id', $productId)->count();

        if (null === $count) {
            throw new StockNotExist($productId);
        }

        return $count;
    }

    public function groupByProductWithDetails()
    {
        $stocks = DB::table('stock_movements')
            ->select(
                'products.name as product_name',
                'categories.name as category_name',
                DB::raw('SUM(stock_movements.quantity) as total_quantity')
            )
            ->join('products', 'stock_movements.product_id', '=', 'products.id')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->groupBy('stock_movements.product_id', 'products.name', 'categories.name')
            ->get();
    }
}
