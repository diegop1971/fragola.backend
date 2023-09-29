<?php

declare(strict_types=1);

namespace src\frontoffice\Categories\Infrastructure\Persistence\Eloquent;

use src\frontoffice\Categories\Domain\CategoryRepository;
use src\frontoffice\Categories\Infrastructure\Persistence\Eloquent\EloquentCategoryModel;



class EloquentCategoryRepository implements CategoryRepository
{
    public function searchAll(): ?array
    {                
        $categories = EloquentCategoryModel::orderBy('id')->get();
        
        if ($categories->isEmpty()) {

            return  $categories = [];
        }
    
        return $categories->toArray();
    }

    public function search($id): ?array
    {
        $category = EloquentCategoryModel::find($id);

        if (null === $category) {
            return null;
        }

        return $category->toArray();
    }

    public function getEnabledCategories(): ?array
    {
        $categories = EloquentCategoryModel::where('enabled', true)
            ->get(['id', 'name']);

        if ($categories->isEmpty()) {
            return [];
        }

        return $categories->toArray();
    }
}
