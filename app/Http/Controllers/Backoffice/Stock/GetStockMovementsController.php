<?php

namespace App\Http\Controllers\Backoffice\Stock;

use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use src\backoffice\Stock\Application\Find\StockGet;
use src\backoffice\Shared\Domain\Interfaces\IErrorMappingService;
use Throwable;

class GetStockMovementsController extends Controller
{
    private $errorMappingService;

    public function __construct(IErrorMappingService $errorMappingService)
    {
        //$this->middleware('auth');
        $this->errorMappingService = $errorMappingService;
    }

    public function __invoke(StockGet $stockGet)
    {
        try {
            $title = 'Stock list';
            $stockList = $stockGet->__invoke();

            return response()->json([
                'title' => $title,
                'stockList' => $stockList,
            ]);
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
