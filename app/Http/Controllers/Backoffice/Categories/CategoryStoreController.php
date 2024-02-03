<?php

namespace App\Http\Controllers\Backoffice\Categories;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use src\Shared\Domain\Bus\Command\CommandBus;
use Illuminate\Validation\ValidationException;
use src\Shared\Domain\ValueObject\Uuid as RamseyUuid;
use src\backoffice\Categories\Application\Create\CreateCategoryCommand;


class CategoryStoreController extends Controller
{
    private $commandBus;
    
    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function __invoke(Request $request)
    {        
        $data = $request->all();
        
        $data = request()->validate([
            'name' => 'required',
            'enabled' => 'required',
            ], [
            'name.required' => 'El nombre de la categoria es obligatorio',
            'enabled.required' => 'El campo enabled es obligatorio',
        ]);

        $command = new CreateCategoryCommand(1,$data['name'], $data['enabled']);

        //$command = new CreateCategoryCommand(RamseyUuid::random(),$data['name'], $data['enabled']);

        try {
            // Código donde se llama a $this->commandBus->execute($command);
            $this->commandBus->execute($command);
        } catch (ValidationException $e) {
            // Manejo de la excepción CommandExecutionException
            // Puedes imprimir un mensaje, registrar el error o tomar alguna otra acción apropiada.
            //echo "Se ha producido una excepción de tipo CommandExecutionException: " . $e->getMessage();
        }

        return redirect()->route('backoffice.categories.index');
    }
}
