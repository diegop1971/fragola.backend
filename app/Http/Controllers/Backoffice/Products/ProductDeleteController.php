<?php

namespace App\Http\Controllers\Backoffice\Products;

use Throwable;
use App\Http\Controllers\Controller;
use src\backoffice\Products\Domain\ProductNotExist;
use src\backoffice\Shared\Domain\Interfaces\IBackOfficeErrorMappingService;
use src\backoffice\Products\Application\Delete\DeleteProductCommand;
use src\backoffice\Products\Application\Delete\DeleteProductCommandHandler;

class ProductDeleteController extends Controller
{
    private $backOfficeErrorMappingService;

    public function __construct(IBackOfficeErrorMappingService $backOfficeErrorMappingService)
    {
        $this->backOfficeErrorMappingService = $backOfficeErrorMappingService;
    }

    public function __invoke($id, DeleteProductCommandHandler $deleteProductCommandHandler)
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
            $mappedError = $this->backOfficeErrorMappingService->mapToHttpCode($e->getCode(), $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => $mappedError['message'],
                'detail' => null,
                'code' => $mappedError['http_code'],
            ], $mappedError['http_code']);
        }
    }
}
