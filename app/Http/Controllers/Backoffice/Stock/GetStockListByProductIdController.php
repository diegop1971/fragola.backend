<?php

namespace App\Http\Controllers\Backoffice\Stock;

use Throwable;
use App\Http\Controllers\Controller;
use src\backoffice\StockMovements\Domain\StockNotExist;
use src\backoffice\Products\Application\Find\ProductFinder;
use src\backoffice\Shared\Domain\Interfaces\IBackOfficeErrorMappingService;
use src\backoffice\StockMovements\Application\Find\GetStockListByProductId;

class GetStockListByProductIdController extends Controller
{
    private $backOfficeErrorMappingService;

    public function __construct(IBackOfficeErrorMappingService $backOfficeErrorMappingService)
    {
        //$this->middleware('auth');
        $this->backOfficeErrorMappingService = $backOfficeErrorMappingService;
    }

    public function __invoke($id, GetStockListByProductId $stockGet, ProductFinder $productFinder)
    {
        try {
            $title = 'Stock movements by product id';

            $stockMovements = $stockGet->__invoke($id);

            $product = $productFinder->__invoke($id);

            return response()->json([
                'pageTitle' => $title,
                'product' => $product,
                'stockMovements' => $stockMovements,
            ]);
        } catch (StockNotExist $e) {
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
