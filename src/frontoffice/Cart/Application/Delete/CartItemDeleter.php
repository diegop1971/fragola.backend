<?php

declare(strict_types=1);

namespace src\frontoffice\Cart\Application\Delete;

use src\frontoffice\Cart\Domain\ICartSessionManager;

final class CartItemDeleter
{
    private $sessionCartItems;

    public function __construct(private ICartSessionManager $sessionManager)
    {
        $this->sessionManager = $sessionManager;
    }

    public function __invoke($index): void
    {
        $this->sessionCartItems = $this->sessionManager->getKeySessionData('cart');

        array_splice($this->sessionCartItems, $index, 1);

        $this->sessionManager->putDataInKeySession('cart', $this->sessionCartItems);
    }
}
