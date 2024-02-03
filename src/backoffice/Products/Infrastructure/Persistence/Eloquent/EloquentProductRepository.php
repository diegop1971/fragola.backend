<?php

declare(strict_types=1);

namespace src\backoffice\Products\Infrastructure\Persistence\Eloquent;

use Illuminate\Support\Facades\Log;
use src\backoffice\Products\Domain\Product;
use src\backoffice\Products\Domain\ProductNotExist;
use src\backoffice\Products\Domain\ProductRepository;
use src\backoffice\Products\Infrastructure\Persistence\Eloquent\ProductEloquentModel;

class EloquentProductRepository implements ProductRepository
{
    public function searchAll(): ?array
    {
        $products = ProductEloquentModel::leftJoin('categories', 'products.category_id', '=', 'categories.id')
            ->select('products.*', 'categories.name as category_name')
            ->get();

        if ($products->isEmpty()) {
            return [];
        }

        return $products->toArray();
    }

    public function search($id): ?array
    {
        $product = ProductEloquentModel::leftJoin('categories', 'products.category_id', '=', 'categories.id')
            ->select('products.*', 'categories.name as category_name')
            ->where('products.id', '=', $id)
            ->first();
        
        if (null === $product) {
            return null;
        }
        
        return $product->toArray();
    }

    public function save(Product $product): void
    {
        Log::info($product->productId()->value());
        Log::info($product->productName()->value());
        Log::info($product->productDescription()->value());
        Log::info($product->productDescriptionShort()->value());
        Log::info($product->productUnitPrice()->value());
        Log::info($product->categoryId()->value());
        Log::info($product->productLowStockAlert()->value());
        Log::info($product->productMinimumQuantity()->value());
        Log::info($product->productLowStockThreshold()->value());
        Log::info($product->ProductEnabled()->value());

        $model = new ProductEloquentModel();

        $model->id = $product->productId()->value();
        $model->name = $product->productName()->value();
        $model->description = $product->productDescription()->value();
        $model->description_short = $product->productDescriptionShort()->value();
        $model->price = $product->productUnitPrice()->value();
        $model->category_id = $product->categoryId()->value();
        $model->low_stock_alert = $product->productLowStockAlert()->value();
        $model->minimum_quantity = $product->productMinimumQuantity()->value();
        $model->low_stock_threshold = $product->productLowStockThreshold()->value();
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
        $model->low_stock_alert = $product->productLowStockAlert()->value();
        $model->minimum_quantity = $product->productMinimumQuantity()->value();
        $model->low_stock_threshold = $product->productLowStockThreshold()->value();
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
