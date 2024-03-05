<?php

namespace App\Http\Controllers\Backoffice\Products;

use Throwable;
use App\Http\Controllers\Controller;
use src\backoffice\Products\Domain\ProductNotExist;
use src\backoffice\Products\Application\Find\ProductFinder;
use src\backoffice\Shared\Domain\Interfaces\IBackOfficeErrorMappingService;

class ProductGetController extends Controller
{
    private $productFinder;
    private $backOfficeErrorMappingService;

    public function __construct(ProductFinder $productFinder, IBackOfficeErrorMappingService $backOfficeErrorMappingService)
    {
        $this->productFinder = $productFinder;
        $this->backOfficeErrorMappingService = $backOfficeErrorMappingService;
    }

    public function __invoke($id)
    {        
        $title = 'Product ';

        try {
            $product = $this->productFinder->__invoke($id);

            return response()->json([
                'title' => $title,
                'product' => $product,
            ], 200);
        } catch (ProductNotExist $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'code' => 404,
            ], 404);
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
