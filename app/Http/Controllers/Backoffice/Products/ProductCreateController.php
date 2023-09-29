<?php

namespace App\Http\Controllers\Backoffice\Products;

use App\Http\Controllers\Controller;
use src\backoffice\Categories\Application\Find\CategoriesGet;

class ProductCreateController extends Controller
{
    public function __invoke(CategoriesGet $categoriesGet)
    {
        $categories = $categoriesGet->__invoke();
        
        $title = 'Ingresar producto';

        return view('components.backoffice.products.create', compact('title', 'categories'));
    }
}
