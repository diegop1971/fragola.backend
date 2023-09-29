<?php

namespace App\Http\Controllers\Backoffice\Stock;

use Throwable;
use App\Exceptions\CustomException;
use App\Http\Controllers\Controller;
use src\backoffice\Stock\Application\Find\StockFinder;

class GetStockMovementController extends Controller
{
    private $stockFinder;

    public function __construct(StockFinder $stockFinder)
    {
        $this->stockFinder = $stockFinder;
    }

    public function __invoke($id)
    {
        try {
            $stockMovement = $this->stockFinder->__invoke($id);
        } catch (Throwable $e) {
            throw new CustomException($e->getMessage());
        }
        
        $title = 'Stock - Ver movimiento ';
        
        return view('components.backoffice.stock.show', compact('stockMovement', 'title'));
    }
}
