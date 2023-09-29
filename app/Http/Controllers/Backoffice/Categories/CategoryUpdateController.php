<?php

namespace App\Http\Controllers\Backoffice\Categories;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use src\backoffice\Categories\Application\Update\UpdateCategoryCommand;
use src\backoffice\Categories\Application\Update\UpdateCategoryCommandHandler;


class CategoryUpdateController extends Controller
{
    private $updateCategoryCommandHandler;

    public function __construct(UpdateCategoryCommandHandler $updateCategoryCommandHandler)
    {
        $this->updateCategoryCommandHandler = $updateCategoryCommandHandler;
    }

    public function __invoke(Request $request)
    {
        
        $data = $request->all();
        
        $data = request()->validate([
            'id' => 'required',
            'name' => 'required',
            'enabled' => 'required',
            ], [
            'id' => 'id',
            'name.required' => 'El nombre de la categoria es obligatorio',
            'enabled' => 'El campo enabled es obligatorio',
        ]);
        
        $this->updateCategoryCommandHandler->__invoke(new UpdateCategoryCommand($data['id'], $data['name'], $data['enabled']));
        
        return redirect()->route('backoffice.categories.index');
    }
}
