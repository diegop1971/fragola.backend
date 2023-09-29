<?php

namespace App\Http\Controllers\Frontoffice\Cart;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use src\frontoffice\Cart\Application\Update\UpdateCartCommand;
use src\frontoffice\Cart\Application\Update\UpdateCartCommandHandler;

class AddToCartController extends Controller
{
    public function __construct(private UpdateCartCommandHandler $updateCartCommandHandler)
    {
        $this->updateCartCommandHandler = $updateCartCommandHandler;
    }

    public function __invoke(Request $request)  
    {
        $productId = $request->input('id');
        $productQty = $request->input('qty');
        
        /*$data = request()->validate([
            'id' => 'required',
            'qty' => 'required',
            ], [
            'id' => 'id',
            'qty.required' => 'La cantidad es obligatoria',

        ]);*/

        $this->updateCartCommandHandler->__invoke(new UpdateCartCommand($productId, $productQty));
        
    }
}
