<?php

namespace App\Http\Controllers\Backoffice\Stock;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use src\Shared\Domain\Bus\Command\CommandBus;
use src\Shared\Domain\ValueObject\Uuid as RamseyUuid;
use src\backoffice\Stock\Application\Create\CreateStockCommand;

class StoreStockMovementController extends Controller
{
    private $commandBus;
    
    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function __invoke(Request $request)
    {        
        $data = $request->all();

        $data = request()->validate([
            'stockProductId' => 'required',
            'stockMovementTypeId' => 'required',
            'stockQuantity' => 'required',
            'stockDate' => 'required',
            'stockNotes' => 'required',
            'stockEnabled' => 'required',
            ], [
            'stockProductId.required' => 'El nombre del producto es obligatorio',
            'stockMovementTypeId.required' => 'El tipo de movimiento de stock es obligatorio',
            'stockQuantity.required' => 'La cantidad de productos ingresados es obligatoria',
            'stockDate.required' => 'La fecha de ingreso es obligatoria',
            'stockNotes.required' => 'Una descripcion o nota es obligatoria',
            'stockEnabled.required' => 'El campo enabled es obligatorio',
        ]);

        $command = new CreateStockCommand(
                                        RamseyUuid::random(), 
                                        $data['stockProductId'], 
                                        $data['stockMovementTypeId'], 
                                        $data['stockQuantity'], 
                                        $data['stockDate'], 
                                        $data['stockNotes'], 
                                        $data['stockEnabled']
                                    );

        $this->commandBus->execute($command);

        return redirect()->route('backoffice.stock.index');
    }
}
