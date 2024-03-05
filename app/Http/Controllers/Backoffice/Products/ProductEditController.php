<?php

namespace App\Http\Controllers\Backoffice\Products;

use Throwable;
use Illuminate\Http\JsonResponse;

use App\Http\Controllers\Controller;
use src\backoffice\Products\Domain\ProductNotExist;
use src\backoffice\Categories\Application\Find\CategoriesGet;
use src\backoffice\Shared\Domain\Interfaces\IBackOfficeErrorMappingService;
use src\backoffice\Products\Application\Find\ProductFinderWithCategory;

class ProductEditController extends Controller
{
    private $productFinderWithCategory;
    private $productList;
    private $categoriesList;
    private $backOfficeErrorMappingService;

    public function __construct(ProductFinderWithCategory $productFinderWithCategory, IBackOfficeErrorMappingService $backOfficeErrorMappingService)
    {
        $this->productFinderWithCategory = $productFinderWithCategory;
        $this->backOfficeErrorMappingService = $backOfficeErrorMappingService;
    }

    public function __invoke($id, CategoriesGet $categoriesGet): JsonResponse
    {
        $title = 'Editar producto';

        try {
            $this->productList = $this->productFinderWithCategory->__invoke($id);

            $this->categoriesList = $categoriesGet->__invoke();

            return response()->json([
                'title' => $title,
                'categories' => $this->categoriesList,
                'productList' => $this->productList,
            ], 200);
        } catch (ProductNotExist $e) {
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
