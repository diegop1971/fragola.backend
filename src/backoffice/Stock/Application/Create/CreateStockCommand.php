<?php

declare(strict_types=1);

namespace src\backoffice\Stock\Application\Create;

use src\Shared\Domain\Bus\Command\Command;

final class CreateStockCommand implements Command
{

    public function __construct(
        private string $stockId,
        private string $stockProductId,
        private int $stockPhysicalQuantity,
        private int $stockUsableQuantity,
    ) {
    }

    public function stockId(): string
    {
        return $this->stockId;
    }

    public function stockProductId(): string
    {
        return $this->stockProductId;
    }

    public function stockPhysicalQuantity(): int
    {
        return $this->stockPhysicalQuantity;
    }

    public function stockUsableQuantity(): int
    {
        return $this->stockUsableQuantity;
    }
}
