<?php

namespace src\backoffice\StockMovementType\Application\Find;

use Throwable;
use App\Http\Controllers\Controller;
use src\backoffice\Stock\Domain\StockNotExist;
use src\backoffice\Categories\Application\Find\CategoriesGet;
use src\backoffice\Shared\Domain\Interfaces\IBackOfficeErrorMappingService;
use src\backoffice\StockMovementType\Application\Find\StockMovementTypesGet;

class CreateStockMovementController extends Controller
{
    private $backOfficeErrorMappingService;

    public function __construct(IBackOfficeErrorMappingService $backOfficeErrorMappingService)
    {
        $this->backOfficeErrorMappingService = $backOfficeErrorMappingService; 
    }

    public function __invoke(StockMovementTypesGet $stockMovementTypeGet, CategoriesGet $categoriesGet)
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
