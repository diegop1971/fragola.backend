<?php

namespace App\Http\Controllers\Backoffice\Stock;

use Throwable;
use App\Http\Controllers\Controller;
use src\backoffice\Stock\Application\Find\StockFinder;
use src\backoffice\Shared\Domain\Interfaces\IBackOfficeErrorMappingService;

class GetStockMovementController extends Controller
{
    private $stockFinder;
    private $backOfficeErrorMappingService;

    public function __construct(StockFinder $stockFinder, IBackOfficeErrorMappingService $backOfficeErrorMappingService)
    {
        //$this->middleware('auth');
        $this->stockFinder = $stockFinder;
        $this->backOfficeErrorMappingService = $backOfficeErrorMappingService;
    }

    public function __invoke($id)
    {
        try {
            $title = 'Stock movement';
            
            $stockItem = $this->stockFinder->__invoke($id);
            return response()->json([
                'title' => $title,
                'stockItem' => $stockItem,
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
