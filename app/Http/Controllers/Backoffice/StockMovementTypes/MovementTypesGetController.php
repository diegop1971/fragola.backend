<?php

namespace App\Http\Controllers\Backoffice\StockMovementTypes;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use src\backoffice\Shared\Domain\Interfaces\IErrorMappingService;
use src\backoffice\StockMovementType\Application\Find\StockMovementTypesGet;

class MovementTypesGetController extends Controller
{
    private $errorMappingService;

    public function __construct(IErrorMappingService $errorMappingService)
    {
        //$this->middleware('auth');
        $this->errorMappingService = $errorMappingService;
    }

    public function __invoke(StockMovementTypesGet $movementTypesGet): JsonResponse
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
