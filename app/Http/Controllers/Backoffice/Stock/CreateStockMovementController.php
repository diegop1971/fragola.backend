<?php

namespace App\Http\Controllers\Backoffice\Stock;

use App\Http\Controllers\Controller;
use src\backoffice\Products\Application\Find\ProductsGet;
use src\backoffice\StockMovementType\Application\Find\StockMovementTypeGet;

class CreateStockMovementController extends Controller
{
    public function __invoke(ProductsGet $ProductsGet, StockMovementTypeGet $stockMovementTypeGet)
    {
        $title = 'Stock - Ingresar movimiento';

        $products = $ProductsGet->__invoke();

        try {
            $stockMovementTypes = $stockMovementTypeGet->__invoke();
            
            return response()->json([
                'title' => $title,
                'products' => $products,
                'stockMovementTypes' => $stockMovementTypes,
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}