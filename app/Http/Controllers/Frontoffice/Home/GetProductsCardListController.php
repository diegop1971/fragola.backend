<?php

namespace App\Http\Controllers\Frontoffice\Home;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use src\frontoffice\Home\Application\Find\GetHomeProducts;

class GetProductsCardListController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function __invoke(GetHomeProducts $homeProducts):JsonResponse
    {
        $title = 'Card List Products';

        $metaDescription = 'CardListProducts meta-description';
        
        $homeProductsData = $homeProducts->__invoke();

        $title = 'Productos';  

        $responseData = [
            'title' => $title,
            'metaDescription' => $metaDescription,
            'homeProducts' => $homeProductsData,
        ];
        
        return response()->json($responseData);
    }
}
