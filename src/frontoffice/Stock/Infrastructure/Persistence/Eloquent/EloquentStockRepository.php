<?php

declare(strict_types=1);

namespace src\frontoffice\Stock\Infrastructure\Persistence\Eloquent;

use Illuminate\Support\Facades\DB;
use src\frontoffice\Stock\Domain\StockNotExist;
use src\frontoffice\Stock\Domain\Interfaces\IStockRepository;
use src\frontoffice\Stock\Infrastructure\Persistence\Eloquent\EloquentStockModel;

class EloquentStockRepository implements IStockRepository
{
    public function groupAndCountStockByProductId(): ?array
    {
        $stockList = DB::table('stock_movements')
            ->select(
                'products.id',
                DB::raw('SUM(stock_movements.system_quantity) as system_stock_quantity'),
                DB::raw('SUM(stock_movements.physical_quantity) as physical_stock_quantity')
            )
            ->join('products', 'stock_movements.product_id', '=', 'products.id')
            ->groupBy('stock_movements.product_id')
            ->get();

        return $stockList->toArray();
    }
}
