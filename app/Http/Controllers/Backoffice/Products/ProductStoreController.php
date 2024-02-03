<?php

namespace App\Http\Controllers\Backoffice\Products;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use src\Shared\Domain\Bus\Command\CommandBus;
use Illuminate\Validation\ValidationException;
use src\Shared\Domain\ValueObject\Uuid as RamseyUuid;
use src\backoffice\Shared\Domain\Interfaces\IErrorMappingService;
use src\backoffice\Products\Application\Create\CreateProductCommand;

class ProductStoreController extends Controller
{
    private $commandBus;
    private $errorMappingService;

    public function __construct(CommandBus $commandBus, IErrorMappingService $errorMappingService)
    {
        $this->commandBus = $commandBus;
        $this->errorMappingService = $errorMappingService;
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
                'low_stock_alert' => 'required|in:0,1',
                'minimum_quantity' => 'required|numeric|min:1',
                'low_stock_threshold' => 'required|numeric|min:1',
                'enabled' => 'required|in:0,1',
            ]);
     
            $id = RamseyUuid::random();
            $description = $data['description'] ?? '';
            $descriptionShort = $data['description_short'] ?? '';
            
            $command = new CreateProductCommand(
                $id,
                $data['name'],
                $description,
                $descriptionShort,
                $data['price'],
                $data['category_id'],
                $data['low_stock_alert'],
                $data['minimum_quantity'],
                $data['low_stock_threshold'],
                $data['enabled'],
            );

            $this->commandBus->execute($command);

            return response()->json([
                'success' => true,
                'message' => "Producto dado de alta correctamente",
                'code' => 200
            ], 200);
        } catch (ValidationException $e) {
            $errors = $e->validator->errors()->toArray();
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'detail' => $errors,
                'code' => 422
            ], 422);
        } catch (\Exception $e) {
            $mappedError = $this->errorMappingService->mapToHttpCode($e->getCode(), $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => $mappedError['message'],
                'details' => null,
                'code' => $mappedError['http_code'],
            ], $mappedError['http_code']);
        }
    }
}
