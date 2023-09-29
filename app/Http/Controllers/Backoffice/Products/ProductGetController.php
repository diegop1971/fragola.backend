<?php

namespace App\Http\Controllers\Backoffice\Products;

use Throwable;
use App\Exceptions\CustomException;
use App\Http\Controllers\Controller;
use src\backoffice\Products\Application\Find\ProductFinder;

class ProductGetController extends Controller
{
    private $productFinder;

    public function __construct(ProductFinder $productFinder)
    {
        $this->productFinder = $productFinder;
    }

    public function __invoke($id)
    {
        try {
            $product = $this->productFinder->__invoke($id);
        } catch (Throwable $e) {
            throw new CustomException($e->getMessage());
        }
        
        $title = 'Producto ';

        return view('components.backoffice.products.show', compact('product', 'title'));
    }
}
