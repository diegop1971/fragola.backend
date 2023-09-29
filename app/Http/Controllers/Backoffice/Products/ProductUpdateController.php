<?php

namespace App\Http\Controllers\Backoffice\Products;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use src\backoffice\Products\Application\Update\UpdateProductCommand;
use src\backoffice\Products\Application\Update\UpdateProductCommandHandler;

class ProductUpdateController extends Controller
{
    private $updateProductCommandHandler;

    public function __construct(UpdateProductCommandHandler $updateProductCommandHandler)
    {
        $this->updateProductCommandHandler = $updateProductCommandHandler;
    }

    public function __invoke(Request $request)
    {
        
        $data = $request->all();

        $data = request()->validate([
                                    'id' => 'required',
                                    'name' => 'required',
                                    'price' => 'required',
                                    'category_id' => 'required',
                                    'minimum_quantity' => 'required',
                                    'low_stock_alert' => 'required',
                                ], [
                                    'id.required' => 'El id del producto es obligatorio',
                                    'name.required' => 'El nombre del producto es obligatorio',
                                    'price.required' => 'El precio unitario es obligatorio',
                                    'category_id.required' => 'El id de categoria es obligatorio',
                                    'minimum_quantity.required' => 'La cantidad mínima de producto en stock es obligatoria',
                                    'low_stock_alert.required' => 'El campo de alerta por bajo stock es obligatorio',
                                ]);
        
        $this->updateProductCommandHandler->__invoke(new UpdateProductCommand(
                                                                            $data['id'], 
                                                                            $data['name'], 
                                                                            $data['description'], 
                                                                            $data['description_short'], 
                                                                            $data['price'], 
                                                                            $data['category_id'],
                                                                            $data['minimum_quantity'],
                                                                            $data['low_stock_threshold'],
                                                                            $data['low_stock_alert'], 
                                                                            $data['enabled'],
                                                                        ));
        
        return redirect()->route('backoffice.products.index');
    }
}
