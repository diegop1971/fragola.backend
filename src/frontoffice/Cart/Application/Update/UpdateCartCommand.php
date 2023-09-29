<?php

declare(strict_types=1);

namespace src\frontoffice\Cart\Application\Update;

use src\Shared\Domain\Bus\Command\Command;

final class UpdateCartCommand implements Command
{
    public function __construct(
            private string $productId, 
            private int $productQty, 
        ) {
    }

    public function productId(): string
    {
        return $this->productId;
    }

    /*public function productName(): string
    {
        return $this->productName;
    }*/

    public function productQty(): int
    {
        return $this->productQty;
    }

    /*public function productUnitPrice(): float
    {
        return $this->productUnitPrice;
    }*/
}
