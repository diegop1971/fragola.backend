<?php

namespace App\Http\Controllers\Backoffice\Products;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use src\backoffice\Products\Domain\ProductNotExist;
use src\backoffice\Products\Application\Find\ProductFinder;
use src\backoffice\Categories\Application\Find\CategoriesGet;

class ProductEditController extends Controller
{
    private $productFinder;
    private $productList;
    private $categoriesList;

    public function __construct(ProductFinder $productFinder)
    {
        $this->productFinder = $productFinder;
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
            ]);
        } catch (ProductNotExist $e) {
            Log::info('ProductNotExist: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'status' => 404,
            ], 404);
        } catch (Exception $e) {
            Log::info('Exception: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'El servidor no pudo completar la solicitud',
                'details' => null,
                'status' => 500,
            ], 500);
        }
    }
}
