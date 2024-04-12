<?php

declare(strict_types=1);

namespace src\frontoffice\Stock\Infrastructure\Persistence\Eloquent;

use Illuminate\Support\Facades\DB;
use src\frontoffice\Stock\Domain\StockNotExist;
use src\frontoffice\Stock\Domain\Interfaces\StockRepositoryInterface;
use src\frontoffice\Stock\Infrastructure\Persistence\Eloquent\EloquentStockModel;

class EloquentStockRepository implements StockRepositoryInterface
{
    public function groupAndCountStockByProductId():?array
    {
        $stockList = DB::table('stock_movements')
            ->select(
                'products.id',
                DB::raw('SUM(stock_movements.quantity) as total_quantity')
            )
            ->join('products', 'stock_movements.product_id', '=', 'products.id')
            ->groupBy('stock_movements.product_id')
            ->get();

        return $stockList->array();
    }

    public function sumStockQuantityByProductId(string $productId): int
    {
        $sum = EloquentStockModel::where('product_id', $productId)->sum('quantity');

        if (null === $sum) {
            throw new StockNotExist($productId);
        }

        return intval($sum);
    }
}
