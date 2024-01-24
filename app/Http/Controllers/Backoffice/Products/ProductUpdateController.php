<?php

namespace App\Http\Controllers\Backoffice\Products;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
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

        try {
            $data = request()->validate([
                'id' => 'required|uuid',
                'name' => 'required|string',
                'description' => 'required|string',
                'description_short' => 'required|string',
                'price' => 'required|numeric|min:1',
                'category_id' => 'required|numeric|min:1',
                'minimum_quantity' => 'required|numeric|min:1',
                'low_stock_threshold' => 'required|numeric|min:1',
                'low_stock_alert' => 'required|in:0,1',
                'enabled' => 'required|in:0,1',
            ], [
                'id.required' => 'El id del producto es obligatorio',
                'name.required' => 'El nombre del producto es obligatorio',
                'descrption.required' => 'La description del producto es obligatoria',
                'descrption_short.required' => 'Una description corta del producto es obligatoria',
                'price.required' => 'El precio unitario es obligatorio',
                'category_id.required' => 'El id de categoria es obligatorio',
                'minimum_quantity.required' => 'La cantidad mínima de producto en stock es obligatoria',
                'low_stock_threshold.required' => 'El campo de alerta por bajo stock es obligatorio',
                'low_stock_alert.required' => 'El campo de alerta por bajo stock es obligatorio',
                'enabled' => 'El campo enabled es obligatorio',
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error de validacion en formulario, el producto no se pudo actualizar!',
                'details' => $e->errors(),
                'code' => 422
            ], 422);
        }

        try {
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
            return response()->json([
                'success' => true,
                'message' => "Producto actualizado correctamente",
                'code' => 200
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'No se actualizó el producto, el servidor no pudo completar la solicitud.',
                'details' => null,
                'code' => 500,
            ], 500);
        }
    }
}
