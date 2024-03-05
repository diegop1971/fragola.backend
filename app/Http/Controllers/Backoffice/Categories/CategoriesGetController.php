<?php

namespace App\Http\Controllers\Backoffice\Categories;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use src\backoffice\Categories\Application\Find\CategoriesGet;
use src\backoffice\Shared\Domain\Interfaces\IBackOfficeErrorMappingService;

class CategoriesGetController extends Controller
{
    private $backOfficeErrorMappingService;

    public function __construct(IBackOfficeErrorMappingService $backOfficeErrorMappingService)
    {
        //$this->middleware('auth');
        $this->backOfficeErrorMappingService = $backOfficeErrorMappingService;
    }

    public function __invoke(CategoriesGet $categoriesGet): JsonResponse
    {
        try {
            $title = 'Categories List';

            $categoriesList = $categoriesGet->__invoke();

            $responseData = [
                'title' => $title,
                'categoriesList' => $categoriesList,
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
