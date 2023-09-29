<?php

namespace App\Http\Controllers\Backoffice\Stock;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use src\backoffice\Stock\Application\Update\UpdateStockCommand;
use src\backoffice\Stock\Application\Update\UpdateStockCommandHandler;

class StockUpdateController extends Controller
{
    private $updateStockCommandHandler;

    public function __construct(UpdateStockCommandHandler $updateStockCommandHandler)
    {
        $this->updateStockCommandHandler = $updateStockCommandHandler;
    }

    public function __invoke(Request $request)
    {
        
        $data = $request->all();

        $data = request()->validate([
            'id' => 'required',
            'product_id' => 'required',
            'movement_type_id' => 'required',
            'quantity' => 'required',
            'date' => 'required',
            'notes' => '',
            'enabled' => 'required',
            ], [
            'id.required' => 'El id del movimiento de stock es obligatorio',
            'product_id.required' => 'El nombre del producto es obligatorio',
            'movement_type_id.required' => 'El tipo de movimiento de stock es obligatorio',
            'quantity.required' => 'La cantidad de productos ingresados es obligatoria',
            'date.required' => 'La fecha de ingreso es obligatoria',
            'enabled.required' => 'El campo enabled es obligatorio',
        ]);
        
        $this->updateStockCommandHandler->__invoke(new UpdateStockCommand(
                                                                            $data['id'], 
                                                                            $data['product_id'], 
                                                                            $data['movement_type_id'], 
                                                                            $data['quantity'], 
                                                                            $data['date'],
                                                                            $data['notes'],  
                                                                            $data['enabled']
                                                                        ));

        return redirect()->route('backoffice.stock.index');
    }
}
