<?php

namespace App\Http\Controllers\Backoffice\Stock;

use Throwable;
use App\Http\Controllers\Controller;
use src\backoffice\Shared\Domain\Interfaces\IErrorMappingService;
use src\backoffice\Stock\Application\Find\GetStockGroupedByProductId;

class GetStockGroupedByProductIdController extends Controller
{
    private $errorMappingService;

    public function __construct(IErrorMappingService $errorMappingService)
    {
        //$this->middleware('auth');
        $this->errorMappingService = $errorMappingService;
    }

    public function __invoke(GetStockGroupedByProductId $stockGet)
    {
        try {
            $pageTitle = 'Stock list';
            $stockItem = $stockGet->__invoke();

            return response()->json([
                'pageTitle' => $pageTitle,
                'stockItem' => $stockItem,
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
