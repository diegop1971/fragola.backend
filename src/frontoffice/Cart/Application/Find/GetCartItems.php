<?php

declare(strict_types=1);

namespace src\frontoffice\Cart\Application\Find;

use src\frontoffice\Cart\Domain\Interfaces\ICartRepository;

final class GetCartItems
{
    private $cartRepository;

    public function __construct(ICartRepository $cartRepository)
    {
        $this->cartRepository = $cartRepository;
    }

    public function __invoke(): array
    {
        $cartItems = $this->cartRepository->searchAll('cart');
        
        return $cartItems;
    }
}
