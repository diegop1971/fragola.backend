<?php

namespace App\Http\Controllers\Frontoffice\Home;

use App\Http\Controllers\Controller;
use src\frontoffice\Home\Application\Find\GetHomeProducts;

class GetProductsCardListController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function __invoke(GetHomeProducts $homeProducts)
    {
        $title = 'Welcome';

        $metaDescription = 'Welcome meta-description';
        
        $homeProducts = $homeProducts->__invoke();

        $title = 'Productos';  

        $data = 'datos del controlador';

        return view('components.frontoffice.home.home-main', compact(['title', 'metaDescription', 'homeProducts']));
    }
}
