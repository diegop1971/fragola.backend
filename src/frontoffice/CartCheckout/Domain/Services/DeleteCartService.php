<?php

namespace src\frontoffice\CartCheckout\Domain\Services;

use src\frontoffice\Cart\Domain\Interfaces\ICartRepository;
use src\frontoffice\CartCheckout\Domain\Interfaces\IDeleteCartService;

class DeleteCartService implements IDeleteCartService
{
    private ICartRepository $cartRepository;

    public function __construct(ICartRepository $cartRepository)
    {
        $this->cartRepository = $cartRepository;    
    }
    
    public function deleteCart(): void
    {
        $this->cartRepository->deleteCart('cart');

    }
}