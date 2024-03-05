<?php

namespace App\Http\Controllers\Backoffice\StockMovementTypes;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use src\backoffice\Shared\Domain\Interfaces\IBackOfficeErrorMappingService;
use src\backoffice\StockMovementType\Application\Find\StockMovementTypesLimitedFieldsGet;

class StockMovementTypesLimitedFieldsGetController extends Controller
{
    private $backOfficeErrorMappingService;

    public function __construct(IBackOfficeErrorMappingService $backOfficeErrorMappingService)
    {
        //$this->middleware('auth');
        $this->backOfficeErrorMappingService = $backOfficeErrorMappingService;
    }

    public function __invoke(StockMovementTypesLimitedFieldsGet $movementTypesGet)//: JsonResponse
    {
        try {
            $title = 'Movement types List';

            $stockMovementTypes = $movementTypesGet->__invoke();

            $responseData = [
                'title' => $title,
                'stockMovementTypes' => $stockMovementTypes,
            ];
            return response()->json($responseData);
        } catch (\Exception $e) {
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
