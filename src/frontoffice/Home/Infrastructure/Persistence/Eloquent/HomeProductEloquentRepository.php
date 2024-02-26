<?php

declare(strict_types=1);

namespace src\frontoffice\Home\Infrastructure\Persistence\Eloquent;

use src\frontoffice\Home\Domain\Interfaces\HomeProductsRepositoryInterface;
use src\frontoffice\Home\Infrastructure\Persistence\Eloquent\HomeProductEloquentModel;

class HomeProductEloquentRepository implements HomeProductsRepositoryInterface
{
    public function getHomeProducts(): ?array
    {
        $products = HomeProductEloquentModel::where('enabled', true)
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
        $model = HomeProductEloquentModel::with(['category'])->find($id);

        if (null === $model) {
            return null;
        }

        return $model->toArray();
    }
}