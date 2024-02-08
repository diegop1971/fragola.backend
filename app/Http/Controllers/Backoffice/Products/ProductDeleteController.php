<?php

namespace App\Http\Controllers\Backoffice\Products;

use App\Http\Controllers\Controller;
use src\backoffice\Products\Domain\ProductNotExist;
use src\backoffice\Shared\Domain\Interfaces\IErrorMappingService;
use src\backoffice\Products\Application\Delete\DeleteProductCommand;
use src\backoffice\Products\Application\Delete\DeleteProductCommandHandler;
use Throwable;

class ProductDeleteController extends Controller
{
    private $errorMappingService;

    public function __construct(IErrorMappingService $errorMappingService)
    {
        $this->errorMappingService = $errorMappingService;
    }

    public function __invoke($id, DeleteProductCommandHandler $deleteProductCommandHandler, IErrorMappingService $errorMappingService)
    {
        try {
            $deleteProductCommandHandler->__invoke(new DeleteProductCommand($id));

            return response()->json([
                'success' => true,
                'message' => "Producto eliminado",
                'code' => 200
            ], 200);
        } catch (ProductNotExist $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'detail' => null,
                'code' => 404,
            ], 404);
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
