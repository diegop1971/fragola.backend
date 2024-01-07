<?php

namespace App\Http\Controllers\Backoffice\Products;

use Exception;
use Illuminate\Http\JsonResponse;
use App\Exceptions\CustomException;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
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
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'El servidor no pudo completar la solicitud',
                'status' => 500,
            ], 500);
        }
    }
}
