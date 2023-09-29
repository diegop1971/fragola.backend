<?php

namespace App\Http\Controllers\Backoffice\Products;

use App\Http\Controllers\Controller;
use src\backoffice\Products\Application\Find\ProductsGet;

class ProductsGetController extends Controller
{
    public function __invoke(ProductsGet $productsGet)
    {
        $products = $productsGet->__invoke();

        $title = 'Productos';

        return view(
                    'components.backoffice.products.index', 
                    compact('products', 'title'
                ));
    }
}
