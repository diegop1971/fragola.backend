<?php

declare(strict_types=1);

namespace src\backoffice\Stock\Application\Create;

use src\Shared\Domain\Bus\Command\Command;

final class CreateStockCommand implements Command
{

    public function __construct(
        private string $stockId,
        private string $stockProductId,
        private int $stockPhysicalStockQuantity,
        private int $stockSystemStockQuantity,
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

    public function stockPhysicalStockQuantity(): int
    {
        return $this->stockPhysicalStockQuantity;
    }

    public function stockSystemStockQuantity(): int
    {
        return $this->stockSystemStockQuantity;
    }
}
