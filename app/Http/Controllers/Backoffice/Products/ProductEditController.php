<?php

namespace App\Http\Controllers\Backoffice\Products;

use Exception;
use App\Exceptions\CustomException;
use App\Http\Controllers\Controller;
use src\backoffice\Products\Application\Find\ProductFinder;
use src\backoffice\Categories\Application\Find\CategoriesGet;
use Illuminate\Http\JsonResponse;

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
            $this->productList = $this->productFinder->__invoke($id);
            
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
