<?php

namespace App\Http\Controllers\Backoffice\Categories;

use Throwable;
use App\Exceptions\CustomException;
use App\Http\Controllers\Controller;
use src\backoffice\Categories\Application\Find\CategoryFinder;

class CategoryGetController extends Controller
{
    private $categoryFinder;

    public function __construct(CategoryFinder $categoryFinder)
    {
        $this->categoryFinder = $categoryFinder;
    }

    public function __invoke($id)
    {
        try {
            $category = $this->categoryFinder->__invoke($id);
        } catch (Throwable $e) {
            throw new CustomException($e->getMessage());
        }
        
        $title = 'Categoria ';

        //return json_encode($category);
        
        return view('components.backoffice.categories.show', compact('category', 'title'));
    }
}
