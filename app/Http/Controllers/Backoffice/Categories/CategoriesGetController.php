<?php

namespace App\Http\Controllers\Backoffice\Categories;

use App\Http\Controllers\Controller;
use src\backoffice\Categories\Application\Find\CategoriesGet;
use Illuminate\Http\JsonResponse;

class CategoriesGetController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function __invoke(CategoriesGet $categoriesGet):JsonResponse
    {
        try {
            $title = 'Categories List';

            $metaDescription = 'CategoriesList meta-description';
            
            $categoriesList = $categoriesGet->__invoke();

            $responseData = [
                'title' => $title,
                'metaDescription' => $metaDescription,
                'categoriesList' => $categoriesList,
            ];
            
            return response()->json($responseData);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
