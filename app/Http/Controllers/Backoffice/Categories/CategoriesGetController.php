<?php

namespace App\Http\Controllers\Backoffice\Categories;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use src\backoffice\Categories\Application\Find\CategoriesGet;
use src\backoffice\Shared\Domain\Interfaces\IErrorMappingService;

class CategoriesGetController extends Controller
{
    private $errorMappingService;

    public function __construct(IErrorMappingService $errorMappingService)
    {
        //$this->middleware('auth');
        $this->errorMappingService = $errorMappingService;
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
