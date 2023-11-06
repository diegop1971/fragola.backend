<?php

namespace App\Http\Controllers\Frontoffice\Cart;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use src\frontoffice\Cart\Domain\ICartSessionManager;
use src\frontoffice\Cart\Domain\Interfaces\ICartRepository;

class AsyncShowCartController extends Controller
{
    private $sessionManager;
    private $cartRepository;

    public function __construct(ICartSessionManager $sessionManager, ICartRepository $cartRepository)
    {
        $this->sessionManager = $sessionManager;
        $this->cartRepository = $cartRepository;
    }

    public function __invoke(Request $request)
    {
        $this->cartRepository->searchAll('cart');

        $customerId = auth()->id();

        session()->put('customerId', $customerId);

        if (!Session()->exists('cart')) {
            $sessionCartItems = [];
            $cartItemCount = 0;
            $cartTotalAmount = 0;
        } else {
            $sessionCartItems = $this->sessionManager->getKeySessionData('cart');
            $cartItemCount = $this->calculateCartTotalItemCount($sessionCartItems);
            $cartTotalAmount = $this->calculateCartTotalAmount($sessionCartItems);
        }
        
        return response()->json([
            'sessionCartItems' => $sessionCartItems, 
            'cartTotalItemCount' => $cartItemCount, 
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
