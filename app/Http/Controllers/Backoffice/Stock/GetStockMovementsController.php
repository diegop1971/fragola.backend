<?php

namespace App\Http\Controllers\Backoffice\Stock;

use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use src\backoffice\Stock\Application\Find\StockGet;

class GetStockMovementsController extends Controller
{
    public function __invoke(StockGet $stockGet)
    {
        $stocks = $stockGet->__invoke();

        $title = 'Stock - Movimientos';
        Log::info($stocks);
        return $stocks;
    }
}
