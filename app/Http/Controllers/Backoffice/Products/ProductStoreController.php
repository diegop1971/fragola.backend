<?php

namespace App\Http\Controllers\Backoffice\Products;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use src\Shared\Domain\Bus\Command\CommandBus;
use src\Shared\Domain\ValueObject\Uuid as RamseyUuid;
use src\backoffice\Products\Application\Create\CreateProductCommand;

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

        try {
            $data = request()->validate([
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

            $id = RamseyUuid::random();
            $description = $data['description'] ?? '';
            $descriptionShort = $data['description_short'] ?? '';
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error de validacion en formulario, el producto no se pudo actualizar!',
                'errors' => $e->errors(),
            ], 200);
        }

        try {
            $command = new CreateProductCommand(
                $id,
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
            
            return response()->json([
                'success' => true,
                "message" => "Producto dado de alta correctamente",
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'El servidor no se encuentra disponible',
                'errors' => $e->getMessage()
            ], 500);
        }
    }
}
