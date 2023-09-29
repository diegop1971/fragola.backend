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

        $stockMovementTypes = $stockMovementTypeGet->__invoke();

        return view('components.backoffice.stock.create', compact(['title', 'products', 'stockMovementTypes']));
    }
}
