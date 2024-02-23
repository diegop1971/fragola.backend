<?php

namespace App\Http\Controllers\Backoffice\Stock;

use Throwable;
use App\Http\Controllers\Controller;
use src\backoffice\Shared\Domain\Interfaces\IErrorMappingService;
use src\backoffice\Stock\Application\Find\GetStockListByProductId;
use src\backoffice\Stock\Domain\StockNotExist;

class GetStockListByProductIdController extends Controller
{
    private $errorMappingService;

    public function __construct(IErrorMappingService $errorMappingService)
    {
        //$this->middleware('auth');
        $this->errorMappingService = $errorMappingService;
    }

    public function __invoke($id, GetStockListByProductId $stockGet)
    {
        try {
            $title = 'Stock movements';

            $stockItem = $stockGet->__invoke($id);

            return response()->json([
                'pageTitle' => $title,
                'stockItem' => $stockItem,
            ]);
        } catch (StockNotExist $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'code' => 404,
            ], 404);
        } catch (Throwable $e) {
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
