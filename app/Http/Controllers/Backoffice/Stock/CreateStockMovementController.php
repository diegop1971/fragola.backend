<?php

namespace App\Http\Controllers\Backoffice\Stock;

use Throwable;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use src\backoffice\Stock\Domain\StockNotExist;
use src\backoffice\Categories\Application\Find\CategoriesGet;
use src\backoffice\Shared\Domain\Interfaces\IErrorMappingService;
use src\backoffice\StockMovementType\Application\Find\StockMovementTypesGet;

class CreateStockMovementController extends Controller
{
    private $errorMappingService;

    public function __construct()
    {
    }

    public function __invoke(StockMovementTypesGet $stockMovementTypeGet, CategoriesGet $categoriesGet, IErrorMappingService $errorMappingService)
    {
        $title = 'Stock - Create Item';
        
        try {
            $stockMovementTypes = $stockMovementTypeGet->__invoke();
            $categories = $categoriesGet->__invoke();

            return response()->json([
                'title' => $title,
                'stockMovementTypes' => $stockMovementTypes,
                'categories' => $categories,
            ], 200);
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
