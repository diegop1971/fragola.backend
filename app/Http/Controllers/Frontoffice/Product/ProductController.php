<?php

namespace App\Http\Controllers\Frontoffice\Product;

use App\Http\Controllers\Controller;
use src\frontoffice\Products\Application\Find\ProductFinder;

class ProductController extends Controller
{
    public function __invoke(ProductFinder $productFinder)
    {
        $id ='129acdbe-51f3-4253-a515-e8cb6f3ce219';

        $product = $productFinder->__invoke($id);

        $title = 'Productos';

        return view(
                    'components.frontoffice.products.product-main',
                    compact('product', 'title')
                );
    }
}
