<?php

namespace App\Http\Controllers\Backoffice\Stock;

use App\Http\Controllers\Controller;
use src\backoffice\Stock\Application\Find\StockGet;

class GetStockMovementsController extends Controller
{
    public function __invoke(StockGet $stockGet)
    {
        $stocks = $stockGet->__invoke();

        $title = 'Stock - Movimientos';

        return view(
                    'components.backoffice.stock.index', 
                    compact('stocks', 'title'
                ));
    }
}
