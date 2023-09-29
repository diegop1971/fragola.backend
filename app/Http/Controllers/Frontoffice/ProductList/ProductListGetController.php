<?php

namespace App\Http\Controllers\Frontoffice\ProductList;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use src\frontoffice\Products\Application\Find\GetEnabledProductsInActiveCategories;

class ProductListGetController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function __invoke(GetEnabledProductsInActiveCategories $productsGet):JsonResponse
    {
        $title = 'Welcome';

        $metaDescription = 'Welcome meta-description';
        
        $products = $productsGet->__invoke();

        $title = 'Productos';

        $data = 'datos del controlador';

        return response()->json($products);

        
        //return view('components.frontoffice.productsList.products-main', compact(['title', 'metaDescription', 'products']));
    }
}
