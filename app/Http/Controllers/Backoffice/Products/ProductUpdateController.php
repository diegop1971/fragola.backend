<?php

namespace App\Http\Controllers\Backoffice\Products;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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
        Log::info($data);
        $data = request()->validate([
                                    'id' => 'required',
                                    'name' => 'required',
                                    'description' => 'required',
                                    'description_short' => 'required',
                                    'price' => 'required',
                                    'category_id' => 'required',
                                    'minimum_quantity' => 'required',
                                    'low_stock_threshold' => 'required',
                                    'low_stock_alert' => 'required',
                                    'enabled' => 'required',
                                ], [
                                    'id.required' => 'El id del producto es obligatorio',
                                    'name.required' => 'El nombre del producto es obligatorio',
                                    'descrption.required' => 'La description del producto es obligatoria',
                                    'descrption_short.required' => 'Una description corta del producto es obligatoria',
                                    'price.required' => 'El precio unitario es obligatorio',
                                    'category_id.required' => 'El id de categoria es obligatorio',
                                    'minimum_quantity.required' => 'La cantidad mínima de producto en stock es obligatoria',
                                    'low_stock_alert.required' => 'El campo de alerta por bajo stock es obligatorio',
                                    'enabled' => 'El campo enabled es obligatorio',
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
        
        //return redirect()->route('backoffice.products.index');
    }
}
