<?php

namespace src\frontoffice\Cart\Domain\Interfaces;

use src\frontoffice\Cart\Domain\Cart;

interface ICartRepository
{
    public function searchAll(string $keyName): ?array;

    // public function search(string $id): ?array;

    // public function save(Stock $stock): void;

    public function update(Cart $cart): void;
    
    // public function delete(string $id): void;

    // public function getStockByProductId(string $productId): ?array;
}
