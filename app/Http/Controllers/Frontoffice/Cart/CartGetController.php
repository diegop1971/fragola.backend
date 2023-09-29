<?php

namespace App\Http\Controllers\Frontoffice\Cart;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use src\frontoffice\Cart\Application\Find\CartGet;

class CartGetController extends Controller
{
    public function __invoke(CartGet $CartGet)
    {
        //$request->session()->put('customerId', 71);

        $sessionCartItems = $CartGet->__invoke();

        return view('components.frontoffice.cart.cart', compact(['sessionCartItems']));
    }
}
