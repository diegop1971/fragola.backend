<?php

namespace App\Http\Controllers\Frontoffice\CartCheckout;

use Throwable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use src\Shared\Domain\Bus\Command\CommandBus;
use Illuminate\Validation\ValidationException;
use src\frontoffice\Shared\Domain\Interfaces\IFrontOfficeErrorMappingService;
use src\frontoffice\CartCheckout\Application\Create\CreateCartCheckoutCommand;

class CartCheckoutStoreController extends Controller
{
    private $commandBus;
    private $frontOfficeErrorMappingService;

    public function __construct(CommandBus $commandBus, IFrontOfficeErrorMappingService $frontOfficeErrorMappingService)
    {
        $this->commandBus = $commandBus;
        $this->frontOfficeErrorMappingService = $frontOfficeErrorMappingService;
    }

    public function __invoke(Request $request)
    {
        $data = $request->all();

        try {
            $data = request()->validate([
                'paymentMethodName' => 'required|string', 
                /*'total_paid' => 'required|numeric|min:1',
                'product_id' => 'required|string',
                'low_stock_alert' => 'required|in:0,1',
                'low_stock_threshold' => 'required|numeric|min:1',
                'out_of_stock' => 'required|in:0,1',
                'enabled' => 'required|in:0,1',*/
            ]);

            /*$productId = RamseyUuid::random();
            $description = $data['description'] ?? '';
            $descriptionShort = $data['description_short'] ?? '';*/

            /*$stockId = RamseyUuid::random();
            $physicalQuantity = 0;
            $usableQuantity = 0;*/

            $command = new CreateCartCheckoutCommand(
                $data['paymentMethodName'],
                /*$productId,
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
                $usableQuantity,*/
            );

            $this->commandBus->execute($command);

            return response()->json([
                'success' => true,
                'message' => "Compra finalizada",
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
            $mappedError = $this->frontOfficeErrorMappingService->mapToHttpCode($e->getCode(), $e->getMessage());

            return response()->json([
                'success' => false,
                //'message' => $mappedError['message'],
                'message' => $e->getMessage(),
                'detail' => null,
                'code' => $mappedError['http_code'],
            ], $mappedError['http_code']);
        }
    }
}
