<?php

declare(strict_types=1);

namespace src\backoffice\Products\Infrastructure\Persistence\Eloquent;

use src\backoffice\Products\Domain\Product;
use src\backoffice\Products\Domain\ProductNotExist;
use src\backoffice\Products\Domain\IProductRepository;
use src\backoffice\Products\Infrastructure\Persistence\Eloquent\ProductEloquentModel;

class EloquentProductRepository implements IProductRepository
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
        $product = ProductEloquentModel::where('id', '=', $id)->first();

        if (null === $product) {
            return null;
        }

        return $product->toArray();
    }

    public function getProductDetailsWithCategory($id): ?array
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

    public function getAllEnabledProductNamesAndIDs(): ?array
    {
        $products = ProductEloquentModel::select('id', 'name')
            ->where('enabled', true)
            ->orderby('name', 'asc')
            ->get();

        if ($products->isEmpty()) {
            return [];
        }

        return $products->toArray();
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
        $model->low_stock_alert = $product->productLowStockAlert()->value();
        $model->low_stock_threshold = $product->productLowStockThreshold()->value();
        $model->out_of_stock = $product->productOutOfStock()->value();
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
        $model->low_stock_threshold = $product->productLowStockThreshold()->value();
        $model->out_of_stock = $product->productOutOfStock()->value();
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
