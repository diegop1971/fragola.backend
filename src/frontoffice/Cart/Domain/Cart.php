<?php

declare(strict_types=1);

namespace src\frontoffice\Cart\Domain;

use src\frontoffice\cart\Domain\ProductId;
use src\frontoffice\Cart\Domain\ProductQty;

final class Cart
{
    public function __construct(
                                private ProductId $productId,
                                private ProductQty $productQty, 
    ) {
    }

    public static function update(
                                ProductId $productId, 
                                ProductQty $productQty,
                            ): self
    {
        $cart = new self($productId, $productQty);

        return $cart;
    }

    public function productId(): ProductId
    {
        return $this->productId;
    }

    /*public function productName(): ProductName
    {
        return $this->productName;
    }*/

    public function productQty(): ProductQty
    {
        return $this->productQty;
    }

    /*public function productUnitPrice(): ProductUnitPrice
    {
        return $this->productUnitPrice;
    }*/
}
