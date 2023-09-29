<?php

namespace App\Http\Controllers\Backoffice\Categories;

use Exception;
use App\Exceptions\CustomException;
use App\Http\Controllers\Controller;
use src\backoffice\Categories\Application\Find\CategoryFinder;

class CategoryEditController extends Controller
{
    private $categoryFinder;

    public function __construct(CategoryFinder $categoryFinder)
    {
        $this->categoryFinder = $categoryFinder;
    }

    public function __invoke($id)
    {
        $title = 'Editar categoria';

        try {
            $category = $this->categoryFinder->__invoke($id);

            $category = [
                'id' => $category['id'],
                'name' => $category['name'],
                'enabled' => $category['enabled'],
            ];
        } catch (Exception $e) {
            throw new CustomException($e->getMessage());
        }

        return view('components.backoffice.categories.edit', compact('title', 'category'));
    }
}
