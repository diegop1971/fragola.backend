<?php

declare(strict_types=1);

namespace src\backoffice\Products\Infrastructure\Persistence\Eloquent;

use src\backoffice\Products\Domain\ProductNotExist;
use src\backoffice\Products\Domain\ProductRepository;
use src\backoffice\Products\Infrastructure\Persistence\Eloquent\ProductEloquentModel;
use src\backoffice\Products\Domain\Product;

class EloquentProductRepository implements ProductRepository
{
    public function searchAll(): ?array
    {                
        //$products = ProductEloquentModel::with('category')->get();

        $products = ProductEloquentModel::with('category')->get();
                                
        if ($products->isEmpty()) {

            return  $products = [];
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

    public function save(Product $product): void
    {
        $model = new ProductEloquentModel();

        $model->id = $product->productId()->value();
        $model->name = $product->productName()->value();
        $model->description = $product->productDescription()->value();
        $model->description_short = $product->productDescriptionShort()->value();
        $model->price = $product->productUnitPrice()->value();
        $model->category_id = $product->categoryId()->value();
        $model->enabled = $product->ProductEnabled()->value();

        $model->save();
    }
    
    public function update(Product $product): void
    {
        $model = ProductEloquentModel::find($product->productId()->value());

        $model->id = $product->productId()->value();
        $model->name = $product->productName()->value();
        $model->description = $product->productDescription()->value();
        $model->description_short = $product->productDescriptionShort()->value();
        $model->price = $product->productUnitPrice()->value();
        $model->category_id = $product->categoryId()->value();
        $model->enabled = $product->ProductEnabled()->value();

        $model->update();
    }
    
    public function delete($id): void
    {
        $model = ProductEloquentModel::find($id);
        
        if (null === $model) {
            throw new ProductNotExist($id);
        }
        
        $model->delete();
    }
}
