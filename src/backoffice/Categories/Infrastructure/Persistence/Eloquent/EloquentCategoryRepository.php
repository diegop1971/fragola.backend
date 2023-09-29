<?php

declare(strict_types=1);

namespace src\backoffice\Categories\Infrastructure\Persistence\Eloquent;

use src\backoffice\Categories\Domain\Category;
use src\backoffice\Categories\Domain\CategoryNotExist;
use src\backoffice\Categories\Domain\CategoryRepository;
use src\backoffice\Categories\Infrastructure\Persistence\Eloquent\EloquentCategoryModel;

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
        $model = EloquentCategoryModel::find($id);

        if (null === $model) {
            return null;
        }

        return $model->toArray();
    }

    public function save(Category $category): void
    {
        $model = new EloquentCategoryModel();

        $model->id = $category->id()->value();
        $model->name = $category->categoryName()->value();;
        $model->enabled = $category->categoryEnabled()->value();

        $model->save();
    }
    
    public function update(Category $category): void
    {
        $model = EloquentCategoryModel::find($category->id()->value());

        $model->id = $category->id()->value();
        $model->name = $category->categoryName()->value();
        $model->enabled = $category->categoryEnabled()->value();

        $model->update();
    }
    
    public function delete($id): void
    {
        $model = EloquentCategoryModel::find($id);
        
        if (null === $model) {
            throw new CategoryNotExist($id);
        }

        $model->delete();
    }
}
