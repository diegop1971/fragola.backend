<?php

declare(strict_types=1);

namespace src\frontoffice\Home\Infrastructure\Persistence\Eloquent;

use Illuminate\Support\Facades\DB;
use src\frontoffice\Home\Domain\Interfaces\HomeProductsRepositoryInterface;
use src\frontoffice\Home\Infrastructure\Persistence\Eloquent\HomeProductEloquentModel;

class HomeProductEloquentRepository implements HomeProductsRepositoryInterface
{
    public function getHomeProducts()
    {
        $products = HomeProductEloquentModel::where('enabled', true)
            ->where('out_of_stock', 0)
            ->whereHas('category', function ($query) {
                $query->where('enabled', true);
            })
            ->leftJoin('stock', 'products.id', '=', 'stock.product_id')
            ->select('products.id', 'products.name', 'products.description', 'products.price', 'products.category_id', DB::raw('COALESCE(SUM(stock.usable_quantity), 0) AS total_quantity'))
            ->groupBy('products.id')
            ->get();

        return $products;
    }

    public function search($id): ?array
    {
        $model = HomeProductEloquentModel::with(['category'])->find($id);

        if (null === $model) {
            return null;
        }

        return $model->toArray();
    }
}
