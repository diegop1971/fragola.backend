<?php

declare(strict_types=1);

namespace src\backoffice\StockMovements\Application\Create;

use src\Shared\Domain\Bus\Command\Command;

final class CreateStockMovementCommand implements Command
{

    public function __construct(
        private string $stockId,
        private string $stockProductId,
        private string $stockMovementTypeId,
        private int $stockQuantity,
        private string $stockMovementsDate,
        private string $stockMovementsNotes,
        private bool $stockMovementsEnabled,
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

    public function stockMovementTypeId(): string
    {
        return $this->stockMovementTypeId;
    }

    public function stockQuantity(): int
    {
        return intval($this->stockQuantity);
    }

    public function stockMovementsDate(): string
    {
        return $this->stockMovementsDate;
    }

    public function stockMovementsNotes(): string
    {
        return $this->stockMovementsNotes;
    }

    public function stockMovementsEnabled(): bool
    {
        return boolval($this->stockMovementsEnabled);
    }
}
