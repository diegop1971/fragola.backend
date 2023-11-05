<?php

namespace App\Http\Controllers\Frontoffice\Cart;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use src\frontoffice\Cart\Domain\ICartSessionManager;


class AsyncShowCartController extends Controller
{
    private $sessionManager;

    public function __construct(ICartSessionManager $sessionManager)
    {
        $this->sessionManager = $sessionManager;
    }

    public function __invoke(Request $request)
    {
        $customerId = auth()->id();

        session()->put('customerId', $customerId);

        if (!Session()->exists('cart')) {
            $sessionCartItems = [];
        } else {
            $sessionCartItems = $this->sessionManager->getKeySessionData('cart');
            $cartTotalItemCount = $this->calculateCartTotalItemCount($sessionCartItems);
            $cartTotalAmount = $this->calculateCartTotalAmount($sessionCartItems);
        }

        return response()->json([
            'sessionCartItems' => $sessionCartItems, 
            'cartTotalItemCount' => $cartTotalItemCount, 
            'cartTotalAmount' => $cartTotalAmount
        ]);
    }

    private function calculateCartTotalItemCount($sessionCartItems) 
    {
        $cartTotalItemCount = array_reduce($sessionCartItems, function($acumulador, $elemento) {
            return $acumulador + $elemento['productQty'];
        }, 0);

        return $cartTotalItemCount;
    }

    private function calculateCartTotalAmount($sessionCartItems) 
    {
        $cartTotalAmount = array_reduce($sessionCartItems, function($acumulador, $elemento) {
            return $acumulador + $elemento['productQty'] * $elemento['productUnitPrice'];
        }, 0);

        return $cartTotalAmount;
    }
}
