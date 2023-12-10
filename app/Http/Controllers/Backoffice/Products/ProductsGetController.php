<?php

namespace App\Http\Controllers\Backoffice\Products;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use src\backoffice\Products\Application\Find\ProductsGet;

class ProductsGetController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function __invoke(ProductsGet $productsGet): JsonResponse
    {
        try {
            $title = 'Product List';
            
            $productsList = $productsGet->__invoke();

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return response()->json([
            'title' => $title,
            'productList' => $productsList,
        ]);

    }
}
