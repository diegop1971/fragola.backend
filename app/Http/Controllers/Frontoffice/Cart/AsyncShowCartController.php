<?php

namespace App\Http\Controllers\Frontoffice\Cart;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use src\frontoffice\Cart\Application\Find\GetCartItems;

class AsyncShowCartController extends Controller
{
    private $getCartItems;
    private $cartItemCount = 0;
    private $cartTotalAmount = 0;

    public function __construct(GetCartItems $getCartItems)
    {
        $this->getCartItems = $getCartItems;
    }

    public function __invoke(Request $request)
    {
        $cartItems = $this->getCartItems->__invoke();

        $customerId = auth()->id();
        session()->put('customerId', $customerId);

        if($cartItems != []) {
            $this->cartItemCount = $this->calculateCartTotalItemCount($cartItems);
            $this->cartTotalAmount = $this->calculateCartTotalAmount($cartItems);
        }

        return response()->json([
            'sessionCartItems' => $cartItems, 
            'cartTotalItemCount' => $this->cartItemCount, 
            'cartTotalAmount' => $this->cartTotalAmount
        ]);
    }

    private function calculateCartTotalItemCount($cartItems) 
    {
        $cartTotalItemCount = array_reduce($cartItems, function($acumulador, $elemento) {
            return $acumulador + $elemento['productQty'];
        }, 0);

        return $cartTotalItemCount;
    }

    private function calculateCartTotalAmount($cartItems) 
    {
        $cartTotalAmount = array_reduce($cartItems, function($acumulador, $elemento) {
            return $acumulador + $elemento['productQty'] * $elemento['productUnitPrice'];
        }, 0);

        return $cartTotalAmount;
    }
}
