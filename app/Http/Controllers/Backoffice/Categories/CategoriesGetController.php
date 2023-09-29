<?php

namespace App\Http\Controllers\Backoffice\Categories;

use App\Http\Controllers\Controller;
use src\backoffice\Categories\Application\Find\CategoriesGet;

class CategoriesGetController extends Controller
{
    public function __invoke(CategoriesGet $categoriesGet)
    {
        $categories = $categoriesGet->__invoke();

        $title = 'Categorias';
        
        return view('components.backoffice.categories.index', compact('categories', 'title'));
    }
}
