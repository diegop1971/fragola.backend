<?php

namespace App\Http\Controllers\Frontoffice\Home;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
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
        try {
            $homeProductsData = $homeProducts->__invoke();

            $title = 'Card List Products';

            $responseData = [
                'title' => $title,
                'homeProducts' => $homeProductsData,
            ];
            return response()->json($responseData);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
