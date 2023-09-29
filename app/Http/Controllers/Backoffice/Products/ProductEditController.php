<?php

namespace App\Http\Controllers\Backoffice\Products;

use Exception;
use App\Exceptions\CustomException;
use App\Http\Controllers\Controller;
use src\backoffice\Products\Application\Find\ProductFinder;
use src\backoffice\Categories\Application\Find\CategoriesGet;

class ProductEditController extends Controller
{
    private $productFinder;

    public function __construct(ProductFinder $productFinder)
    {
        $this->productFinder = $productFinder;
    }

    public function __invoke($id, CategoriesGet $categoriesGet)
    {
        $title = 'Editar producto';

        $categories = $categoriesGet->__invoke();

        try {
            $product = $this->productFinder->__invoke($id);

            $product = [
                'id' => $product['id'],
                'name' => $product['name'],
                'description' => $product['description'],
                'price' => $product['price'],
                'category_id' => $product['category_id'],
                'enabled' => $product['enabled'],
            ];
        } catch (Exception $e) {
            throw new CustomException($e->getMessage());
        }

        return view('components.backoffice.products.edit', compact('title', 'product', 'categories'));
    }
}
