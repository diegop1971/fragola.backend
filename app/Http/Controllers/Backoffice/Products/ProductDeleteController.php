<?php

namespace App\Http\Controllers\Backoffice\Products;

use Throwable;
use App\Http\Controllers\Controller;
use src\backoffice\Products\Application\Delete\DeleteProductCommand;
use src\backoffice\Products\Application\Delete\DeleteProductCommandHandler;
use src\backoffice\Products\Infrastructure\Persistence\Eloquent\ProductEloquentModel;

class ProductDeleteController extends Controller
{
    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke($id, DeleteProductCommandHandler $deleteProductCommandHandler)
    {
        try {
            $deleteProductCommandHandler->__invoke(new DeleteProductCommand($id));
        } catch (Throwable $e) {
            return redirect()->route('backoffice.products.index');
        }
        
        return redirect()->route('backoffice.products.index');
    }
}