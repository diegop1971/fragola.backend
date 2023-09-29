<?php

declare(strict_types=1);

namespace src\frontoffice\Products\Infrastructure\Persistence\Eloquent;

use src\frontoffice\Products\Domain\ProductRepository;
use src\frontoffice\Products\Infrastructure\Persistence\Eloquent\ProductEloquentModel;

class EloquentProductRepository implements ProductRepository
{
    public function getEnabledProductsInActiveCategories(): ?array
    {
        $products = ProductEloquentModel::where('enabled', true)
            ->whereHas('category', function ($query) {
                $query->where('enabled', true);
            })
            ->get(['id', 'name', 'description', 'price', 'category_id']);

        if ($products->isEmpty()) {
            return [];
        }

        return $products->toArray();
    }

    public function search($id): ?array
    {
        $model = ProductEloquentModel::with(['category'])->find($id);

        if (null === $model) {
            return null;
        }

        return $model->toArray();
    }    
}