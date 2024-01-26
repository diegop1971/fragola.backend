<?php

namespace App\Http\Controllers\Backoffice\Products;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use src\backoffice\Shared\Domain\Interfaces\IErrorMappingService;
use src\backoffice\Products\Application\Update\UpdateProductCommand;
use src\backoffice\Products\Application\Update\UpdateProductCommandHandler;

class ProductUpdateController extends Controller
{
    private $updateProductCommandHandler;
    private $errorMappingService;

    public function __construct(UpdateProductCommandHandler $updateProductCommandHandler, IErrorMappingService $errorMappingService)
    {
        $this->updateProductCommandHandler = $updateProductCommandHandler;
        $this->errorMappingService = $errorMappingService;
    }

    public function __invoke(Request $request)
    {
        $data = $request->all();

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
            'description.required' => 'La descripción del producto es obligatoria',
            'description_short.required' => 'Una descripción corta del producto es obligatoria',
            'price.required' => 'El precio unitario es obligatorio',
            'category_id.required' => 'El id de categoría es obligatorio',
            'minimum_quantity.required' => 'La cantidad mínima de producto en stock es obligatoria',
            'low_stock_threshold.required' => 'El campo de alerta por bajo stock es obligatorio',
            'low_stock_alert.required' => 'El campo de alerta por bajo stock es obligatorio',
            'enabled' => 'El campo enabled es obligatorio',
        ]);

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
            $mappedError =$this->errorMappingService->mapToHttpCode(422);
            return response()->json([
                'success' => false,
                'message' => 'No se actualizó el producto, el servidor no pudo completar la solicitud.',
                'details' => null,
                'code' => $mappedError,
            ], 500);
        }
    }
}
