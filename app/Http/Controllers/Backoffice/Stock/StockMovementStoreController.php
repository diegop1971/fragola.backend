<?php

namespace App\Http\Controllers\Backoffice\Stock;

use Throwable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use src\Shared\Domain\Bus\Command\CommandBus;
use Illuminate\Validation\ValidationException;
use src\Shared\Domain\ValueObject\Uuid as RamseyUuid;
use src\backoffice\Stock\Application\Create\CreateStockCommand;
use src\backoffice\Shared\Domain\Interfaces\IErrorMappingService;

class StockMovementStoreController extends Controller
{
    private $commandBus;
    private $errorMappingService;

    public function __construct(CommandBus $commandBus, IErrorMappingService $errorMappingService)
    {
        $this->commandBus = $commandBus;
        $this->errorMappingService = $errorMappingService;
    }

    public function __invoke(Request $request)
    {
        $data = $request->all();
        
        try {
            $data = request()->validate([
                'product_id' => 'required|uuid',
                'movement_type_id' => 'required|uuid',
                'quantity' => 'required|numeric|min:1',
                'date' => 'required|date',
                'notes' => 'nullable|string',
                'enabled' => 'required|in:0,1',
            ]);
            Log::info($data);
            $command = new CreateStockCommand(
                RamseyUuid::random(),
                $data['product_id'],
                $data['quantity'],
                $data['quantity'],
            );
            /*
            $command = new CreateStockCommand(
                RamseyUuid::random(),
                $data['product_id'],
                $data['movement_type_id'],
                $data['quantity'],
                $data['date'],
                $data['notes'] ? $data['notes'] : '',
                $data['enabled']
            );
            */

            $this->commandBus->execute($command);

            return response()->json([
                'success' => true,
                'message' => "Movimiento de stock registrado correctamente",
                'code' => 200
            ], 200);
        } catch (ValidationException $e) {
            $errors = $e->validator->errors()->toArray();
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'detail' => $errors,
                'code' => 422
            ], 422);
        } catch (Throwable $e) {
            $mappedError = $this->errorMappingService->mapToHttpCode($e->getCode(), $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => $mappedError['message'],
                'detail' => null,
                'code' => $mappedError['http_code'],
            ], $mappedError['http_code']);
        }
    }
}
