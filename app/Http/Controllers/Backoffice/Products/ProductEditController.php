<?php

namespace App\Http\Controllers\Backoffice\Products;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

use src\backoffice\Products\Domain\ProductNotExist;
use src\backoffice\Products\Application\Find\ProductFinder;
use src\backoffice\Categories\Application\Find\CategoriesGet;
use src\backoffice\Shared\Domain\Interfaces\IErrorMappingService;

class ProductEditController extends Controller
{
    private $productFinder;
    private $productList;
    private $categoriesList;
    private $errorMappingService;

    public function __construct(ProductFinder $productFinder, IErrorMappingService $errorMappingService)
    {
        $this->productFinder = $productFinder;
        $this->errorMappingService = $errorMappingService;
    }

    public function __invoke($id, CategoriesGet $categoriesGet): JsonResponse
    {
        $title = 'Editar producto';

        try {
            $this->productList = $this->productFinder->__invoke($id);

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
