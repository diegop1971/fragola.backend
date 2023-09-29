<?php

namespace App\Http\Controllers\Backoffice\Categories;

use Throwable;
use App\Http\Controllers\Controller;

use src\backoffice\Categories\Domain\CategoryNotExist;
use src\backoffice\Categories\Application\Delete\DeleteCategoryCommand;
use src\backoffice\Categories\Application\Delete\DeleteCategoryCommandHandler;

class CategoryDeleteController extends Controller
{
    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke($id, DeleteCategoryCommandHandler $deleteCategoryCommandHandler)
    {
        try {
            $deleteCategoryCommandHandler->__invoke(new DeleteCategoryCommand($id));
        } catch (Throwable $e) {
            // throw new CategoryNotExist($id);
            return redirect()->route('backoffice.categories.index');
        }
        
        return redirect()->route('backoffice.categories.index');
    }
}