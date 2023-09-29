<?php

namespace App\Http\Controllers\Backoffice\Stock;

use Throwable;
use App\Http\Controllers\Controller;
use src\backoffice\Stock\Application\Delete\DeleteStockCommand;
use src\backoffice\Stock\Application\Delete\DeleteStockCommandHandler;


class DeleteStockMovementController extends Controller
{
    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke($id, DeleteStockCommandHandler $deleteStockCommandHandler)
    {
        try {
            $deleteStockCommandHandler->__invoke(new DeleteStockCommand($id));
        } catch (Throwable $e) {
            return redirect()->route('backoffice.stock.index');
        }
        
        return redirect()->route('backoffice.stock.index');
    }
}