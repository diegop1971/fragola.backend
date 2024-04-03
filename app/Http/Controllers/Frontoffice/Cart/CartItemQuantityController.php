<?php

namespace App\Http\Controllers\Frontoffice\Cart;

use Throwable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use src\frontoffice\Cart\Domain\ICartSessionManager;
use src\frontoffice\Home\Application\Find\HomeProductFinder;
use src\backoffice\Shared\Domain\Interfaces\IBackOfficeErrorMappingService;
use src\frontoffice\Shared\Domain\Interfaces\IFrontOfficeErrorMappingService;


class CartItemQuantityController extends Controller
{
    private $sessionManager;
    private $sessionCartItems = [];
    private $cartItems = [];
    private $item;
    private $flag;
    private $frontOfficeErrorMappingService;

    public function __construct(ICartSessionManager $sessionManager, IFrontOfficeErrorMappingService $frontOfficeErrorMappingService)
    {
        $this->sessionManager = $sessionManager;
        $this->frontOfficeErrorMappingService = $frontOfficeErrorMappingService;
    }

    public function __invoke(Request $request, HomeProductFinder $homeProductFind)
    {
        try {
            $id = $request->input('id');
            $qty = $request->input('qty');

            $product = $homeProductFind->__invoke($id);

            $this->item = [
                'productId' => $product['id'],
                'productName' => $product['name'],
                'productQty' => $qty,
                'productUnitPrice' => round($product['price'], 2)
            ];

            if (!$request->Session()->exists('cart')) {
                array_push($this->cartItems, $this->item);
                $this->sessionManager->putDataInKeySession('cart', $this->cartItems);
            } else {
                $this->sessionCartItems = $this->sessionManager->getKeySessionData('cart');

                foreach ($this->sessionCartItems as $sessionCartItem) {
                    if (in_array($this->item['productId'], $sessionCartItem)) {
                        $cant = $qty;

                        $sessionCartItem = array_replace($sessionCartItem, [
                            'productId' => $product['id'],
                            'productName' => $product['name'],
                            'productQty' => $cant,
                            'productUnitPrice' => round($product['price'], 2)
                        ]);
                        $this->flag = true;
                    }
                    array_push($this->cartItems, $sessionCartItem);
                }
                if (!$this->flag) {
                    array_push($this->cartItems, $this->item);
                }

                $this->sessionManager->putDataInKeySession('cart', $this->cartItems);
            }
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
                'message' => $mappedError['message'],
                'detail' => null,
                'code' => $mappedError['http_code'],
            ], $mappedError['http_code']);
        }
    }
}
