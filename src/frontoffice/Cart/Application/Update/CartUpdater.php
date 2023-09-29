<?php

namespace src\frontoffice\Cart\Application\Update;

use Illuminate\Support\Facades\Log;
use src\frontoffice\Cart\Domain\Cart;
use src\frontoffice\Cart\Domain\ProductId;
use src\frontoffice\Cart\Domain\ProductQty;
use src\frontoffice\Cart\Domain\ICartSessionManager;
use src\frontoffice\Cart\Domain\Interfaces\ICartRepository;

class CartUpdater
{
    public function __construct(
                                private ICartSessionManager $sessionManager, 
                                private ICartRepository $cartRepository
                            )
    {
        $this->sessionManager = $sessionManager;
    }

    public function __invoke(
                            ProductId $productId,
                            ProductQty $productQty
                        ): void  
    {
        $cart = Cart::update($productId, $productQty);

        $this->cartRepository->update($cart);
    }
}
