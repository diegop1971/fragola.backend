<?php

namespace App\Http\Controllers\Backoffice\Products;

use Throwable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use src\Shared\Domain\Bus\Command\CommandBus;
use Illuminate\Validation\ValidationException;
use src\Shared\Domain\ValueObject\Uuid as RamseyUuid;
use src\backoffice\Shared\Domain\Interfaces\IBackOfficeErrorMappingService;
use src\backoffice\Products\Application\Create\CreateProductCommand;

class OrderStoreController extends Controller
{
    private $commandBus;
    private $backOfficeErrorMappingService;

    public function __construct(CommandBus $commandBus, IBackOfficeErrorMappingService $backOfficeErrorMappingService)
    {
        $this->commandBus = $commandBus;
        $this->backOfficeErrorMappingService = $backOfficeErrorMappingService;
    }

    public function __invoke(Request $request)
    {
        $data = $request->all();

        try {
            $data = request()->validate([
                'total_paid' => 'required|numeric|min:1',
                'product_id' => 'required|string',
                'low_stock_alert' => 'required|in:0,1',
                'low_stock_threshold' => 'required|numeric|min:1',
                'out_of_stock' => 'required|in:0,1',
                'enabled' => 'required|in:0,1',
            ]);

            $productId = RamseyUuid::random();
            $description = $data['description'] ?? '';
            $descriptionShort = $data['description_short'] ?? '';

            $stockId = RamseyUuid::random();
            $physicalQuantity = 0;
            $usableQuantity = 0;

            $command = new CreateProductCommand(
                $productId,
                $data['name'],
                $description,
                $descriptionShort,
                $data['price'],
                $data['category_id'],
                $data['low_stock_alert'],
                $data['low_stock_threshold'],
                $data['out_of_stock'],
                $data['enabled'],
                $stockId,
                $physicalQuantity,
                $usableQuantity,

            );

            $this->commandBus->execute($command);
            
            return response()->json([
                'success' => true,
                'message' => "Producto dado de alta correctamente",
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
            $mappedError = $this->backOfficeErrorMappingService->mapToHttpCode($e->getCode(), $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => $mappedError['message'],
                'detail' => null,
                'code' => $mappedError['http_code'],
            ], $mappedError['http_code']);
        }
    }
}
