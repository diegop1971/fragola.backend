<?php

declare(strict_types=1);

namespace src\frontoffice\Cart\Application\Find;

use src\frontoffice\Cart\Domain\ICartSessionManager;
use Illuminate\Support\Facades\Log;

final class CartGet
{
    private $sessionManager;

    public function __construct(ICartSessionManager $sessionManager)
    {
        $this->sessionManager = $sessionManager;
    }

    public function __invoke(): array
    {
        Log::info('peperoni');
        $sessionCartItems = $this->sessionManager->getKeySessionData('cart');

        return $sessionCartItems;
    }
}
