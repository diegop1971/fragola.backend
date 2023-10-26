<?php

namespace App\Http\Controllers\Backoffice\Products;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use src\Shared\Domain\Bus\Command\CommandBus;
use src\backoffice\Products\Application\Create\CreateProductCommand;
use src\Shared\Domain\ValueObject\Uuid as RamseyUuid;

class ProductStoreController extends Controller
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
            'name' => 'required',
            'price' => 'required',
            'category_id' => 'required',
            'minimum_quantity' => 'required',
            'low_stock_threshold' => 'required',
            'low_stock_alert' => 'required',
            'enabled' => 'required',
            ], [
                'name.required' => 'El nombre del producto es obligatorio',
                'price.required' => 'El precio unitario es obligatorio',
                'category_id.required' => 'El id de categoria es obligatorio',
                'minimum_quantity.required' => 'La cantidad mínima de producto en stock es obligatoria',
                'low_stock_alert.required' => 'El campo de alerta por bajo stock es obligatorio',
        ]);

        $description = $data['description'] ?? '';
        $descriptionShort = $data['description_short'] ?? '';
        
        $command = new CreateProductCommand(
                                            //RamseyUuid::random(), 
                                            $data['id'],
                                            $data['name'], 
                                            $description, 
                                            $descriptionShort, 
                                            $data['price'], 
                                            $data['category_id'],
                                            $data['minimum_quantity'],
                                            $data['low_stock_threshold'],
                                            $data['low_stock_alert'], 
                                            $data['enabled'],
                                        );

        $this->commandBus->execute($command);

        return redirect()->route('backoffice.products.index');
    }
}
