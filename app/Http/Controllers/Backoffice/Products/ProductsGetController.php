<?php

namespace App\Http\Controllers\Backoffice\Products;

use Throwable;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use src\backoffice\Products\Application\Find\ProductsGet;
use src\backoffice\Shared\Domain\Interfaces\IBackOfficeErrorMappingService;

class ProductsGetController extends Controller
{
    private $backOfficeErrorMappingService;

    public function __construct(IBackOfficeErrorMappingService $backOfficeErrorMappingService)
    {
        //$this->middleware('auth');
        $this->backOfficeErrorMappingService = $backOfficeErrorMappingService;
    }

    public function __invoke(ProductsGet $productsGet): JsonResponse
    {
        try {
            $title = 'Product List';
            $productsList = $productsGet->__invoke();

            return response()->json([
                'title' => $title,
                'productList' => $productsList,
            ]);
        } catch (Throwable $e) {
            $mappedError = $this->backOfficeErrorMappingService->mapToHttpCode($e->getCode(), $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => $mappedError['message'],
                'details' => null,
                'code' => $mappedError['http_code'],
            ], $mappedError['http_code']);
        }
    }
}
