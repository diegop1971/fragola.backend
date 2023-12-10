<?php

namespace App\Http\Controllers\Backoffice\Products;

use Exception;
use App\Exceptions\CustomException;
use App\Http\Controllers\Controller;
use src\backoffice\Products\Application\Find\ProductFinder;
use src\backoffice\Categories\Application\Find\CategoriesGet;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class ProductEditController extends Controller
{
    private $productFinder;
    private $productList;

    public function __construct(ProductFinder $productFinder)
    {
        $this->productFinder = $productFinder;
    }

    public function __invoke($id, CategoriesGet $categoriesGet): JsonResponse
    {
        $title = 'Editar producto';

        $categories = $categoriesGet->__invoke();

        try {
            $product = $this->productFinder->__invoke($id);
            
            $this->productList = [
                'id' => $product->id,
                'name' => $product->name,
                'description' => $product->description,
                'price' => $product->price,
                'category_id' => $product->category_id,
                'category_name' => $product->category_name,
                'enabled' => $product->enabled,
            ];
            log::info($this->productList);
        } catch (Exception $e) {
            //throw new CustomException($e->getMessage());
            throw new Exception($e);
        }
        
        return response()->json([
            'title' => $title,
            'categories' => $categories,
            'productList' => $this->productList,
        ]);
    }
}
