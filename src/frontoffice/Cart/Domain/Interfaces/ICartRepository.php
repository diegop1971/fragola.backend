<?php

namespace src\frontoffice\Cart\Domain\Interfaces;

use src\frontoffice\Cart\Domain\Cart;

interface ICartRepository
{
    public function searchAll(string $keyName): ?array;

    public function update(Cart $cart): void;
    
    public function deleteCart(string $keyName): void;

}
