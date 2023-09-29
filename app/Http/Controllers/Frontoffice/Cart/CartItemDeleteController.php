<?php

namespace App\Http\Controllers\Frontoffice\Cart;

use App\Http\Controllers\Controller;
use src\frontoffice\Cart\Application\Delete\DeleteCartItemCommand;
use src\frontoffice\Cart\Application\Delete\DeleteCartItemCommandHandler;

class CartItemDeleteController extends Controller
{
    public function __invoke($index, DeleteCartItemCommandHandler $deleteCartItemCommandHandler): void
    {
        $deleteCartItemCommandHandler->__invoke(new DeleteCartItemCommand($index));
    }
}
