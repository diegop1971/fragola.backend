<?php

namespace App\Http\Controllers\Backoffice\Categories;

use App\Http\Controllers\Controller;

class CategoryCreateController extends Controller
{
    public function __invoke()
    {
        return view('components.backoffice.categories.create', ['title' => 'Crear nueva categoria']);
    }
}
