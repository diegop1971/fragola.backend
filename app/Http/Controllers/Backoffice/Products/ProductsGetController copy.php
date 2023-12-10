<?php

namespace App\Http\Controllers\Backoffice\Products;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use src\backoffice\Products\Application\Find\ProductsGet;
use Illuminate\Support\Facades\Log;

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
            
            $products = $productsGet->__invoke();

            $productsList = [
                'id' => $products['id'],
                'category_id' => $products['category_id'],
                'category' => $products['category']['name'],
                'name' => $products['name'],
                'description' => $products['description'],
                'description_short' => $products['description_short'],
                'price' => $products['price'],
                'minimum_quantity' => $products['minimum_quantity'],
                'low_stock_threshold' => $products['low_stock_threshold'],
                'low_stock_alert' => $products['low_stock_alert'],
                'enabled' => $products['enabled'],
                'created_at' => $products['created_at'],
                'updated_at' => $products['updated_at'],
            ];
            
            //log::info($productsList);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return response()->json([
            'title' => $title,
            'productList' => $productsList,
        ]);

    }
}
