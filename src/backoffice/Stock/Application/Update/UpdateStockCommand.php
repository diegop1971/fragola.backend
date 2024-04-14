<?php

declare(strict_types=1);

namespace src\backoffice\Stock\Application\Update;

use src\Shared\Domain\Bus\Command\Command;

final class UpdateStockCommand implements Command
{
    public function __construct(
        private string $stockId,
        private string $stockProductId,
        private int $physicalStockQuantity,
        private int $systemStockQuantity,
    ) {
        $this->stockId = $stockId;
        $this->stockProductId = $stockProductId;
        $this->physicalStockQuantity = $physicalStockQuantity;
        $this->systemStockQuantity = $systemStockQuantity;
    }

    public function stockId(): string
    {
        return $this->stockId;
    }

    public function stockProductId(): string
    {
        return $this->stockProductId;
    }

    public function physicalStockQuantity(): int
    {
        return $this->physicalStockQuantity;
    }

    public function systemStockQuantity(): int
    {
        return $this->systemStockQuantity;
    }
}
