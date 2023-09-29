<?php

namespace App\Http\Controllers\Backoffice\Stock;

use Exception;
use App\Exceptions\CustomException;
use App\Http\Controllers\Controller;
use src\backoffice\Stock\Application\Find\StockFinder;
use src\backoffice\Products\Application\Find\ProductsGet;
use src\backoffice\StockMovementType\Application\Find\StockMovementTypeGet;

class EditStockMovementController extends Controller
{
    private $stockFinder;

    public function __construct(StockFinder $stockFinder)
    {
        $this->stockFinder = $stockFinder;
    }

    public function __invoke($id, ProductsGet $productsGet, StockMovementTypeGet $stockMovementTypeGet)
    {
        $title = 'Stock - Editar movimiento';

        $products = $productsGet->__invoke();

        $stockMovementTypes = $stockMovementTypeGet->__invoke();

        try {
            $stockMovement = $this->stockFinder->__invoke($id);

        } catch (Exception $e) {
            throw new CustomException($e->getMessage());
        }

        return view(
                    'components.backoffice.stock.edit', 
                    compact('title', 'stockMovement', 'products', 'stockMovementTypes'
                ));
    }
}
