<?php

namespace App\Http\Controllers\Frontoffice\Cart;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DeleteCartController extends Controller
{
    public function __invoke(Request $request)
    {
        session()->forget('cart');
    }
}
