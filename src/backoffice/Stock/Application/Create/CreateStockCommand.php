<?php

declare(strict_types=1);

namespace src\backoffice\Stock\Application\Create;

use src\Shared\Domain\Bus\Command\Command;

final class CreateStockCommand implements Command
{

    public function __construct(
        private string $stockId, 
        private string $stockProductId, 
        private int $stockMovementTypeId, 
        private int $stockQuantity, 
        private string $stockDate, 
        private string $stockNotes,
        private bool $stockEnabled,
        )   {
    }

    public function stockId(): string
    {
        return $this->stockId;
    }

    public function stockProductId(): string
    {
        return $this->stockProductId;
    }

    public function stockMovementTypeId(): int
    {
        return $this->stockMovementTypeId;
    }

    public function stockQuantity(): int
    {
        return intval($this->stockQuantity);
    }

    public function stockDate(): string
    {
        return $this->stockDate;
    }

    public function stockNotes(): string
    {
        return $this->stockNotes;
    }

    public function stockEnabled(): bool
    {
        return boolval($this->stockEnabled);
    }
}
