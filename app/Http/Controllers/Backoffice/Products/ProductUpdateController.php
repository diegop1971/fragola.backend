<?php

namespace App\Http\Controllers\Backoffice\Products;

use Throwable;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
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
        try {
            $data = $request->all();
            Log::info($data);
            $data = request()->validate([
                'id' => 'required|uuid',
                'name' => 'required|string',
                'description' => 'required|string',
                'description_short' => 'required|string',
                'price' => 'required|numeric|min:1',
                'category_id' => 'required|string',
                'low_stock_alert' => 'required|in:0,1',
                'low_stock_threshold' => 'required|numeric|min:1',
                'out_of_stock' => 'required|in:0,1',
                'enabled' => 'required|in:0,1',
            ]);
            
            $this->updateProductCommandHandler->__invoke(new UpdateProductCommand(
                $data['id'],
                $data['name'],
                $data['description'],
                $data['description_short'],
                $data['price'],
                $data['category_id'],
                $data['low_stock_alert'],
                $data['low_stock_threshold'],
                $data['out_of_stock'],
                $data['enabled'],
            ));
            return response()->json([
                'success' => true,
                'message' => "Producto actualizado correctamente",
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
        } catch (Throwable $e) {
            $mappedError = $this->errorMappingService->mapToHttpCode($e->getCode(), $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => $mappedError['message'],
                'detail' => null,
                'code' => $mappedError['http_code'],
            ], $mappedError['http_code']);
        }
    }
}
