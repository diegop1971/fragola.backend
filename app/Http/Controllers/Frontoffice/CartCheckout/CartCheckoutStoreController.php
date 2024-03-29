<?php

namespace App\Http\Controllers\Frontoffice\CartCheckout;

use Throwable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use src\Shared\Domain\Bus\Command\CommandBus;
use Illuminate\Validation\ValidationException;
use src\Shared\Domain\ValueObject\PasswordValueObject;
use src\frontoffice\Customers\Domain\ValueObjects\CustomerPassword;
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
                'customerId' => 'nullable|uuid',
                'customerEmail' => 'required|string',
                'firstName' =>  'required|string',
                'lastName' =>  'required|string',
                'paymentMethodId' => 'required|string',
                'cartData.sessionCartItems.*.productId' => 'required|uuid',
                'cartData.sessionCartItems.*.productName' => 'required|string',
                'cartData.sessionCartItems.*.productQty' => 'required|integer|min:1',
                'cartData.sessionCartItems.*.productUnitPrice' => 'required|numeric|min:0',
                'cartData.cartTotalItemCount' => 'required|integer|min:1',
                'cartData.cartTotalAmount' => 'required|numeric|min:0',
            ]);

            $command = new CreateCartCheckoutCommand(
                $data['customerId'],
                $data['customerEmail'],
                $data['firstName'],
                $data['lastName'],
                $data['paymentMethodId'],
                $data['cartData']['cartTotalItemCount'],
                $data['cartData']['cartTotalAmount'],
                $data['cartData']['sessionCartItems'],
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
