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
        }

        return $sessionCartItems;
    }
}
