<?php

declare(strict_types=1);

namespace src\backoffice\Stock\Application\Update;

use src\Shared\Domain\Bus\Command\Command;

final class UpdateStockCommand implements Command
{
    public function __construct(
                                private string $id, 
                                private string $product_id, 
                                private int $movement_type_id, 
                                private int $quantity, 
                                private string $date, 
                                private string $notes, 
                                private bool $enabled
                            )
    {
        $this->id = $id;
        $this->product_id = $product_id;
        $this->movement_type_id = $movement_type_id;
        $this->quantity = $quantity;
        $this->date = $date;
        $this->notes = $notes;
        $this->enabled = $enabled;
    }

    public function stockId(): string
    {
        return $this->id;
    }

    public function stockProductId(): string
    {
        return $this->product_id;
    }

    public function stockMovementTypeId(): int
    {
        return $this->movement_type_id;
    }

    public function stockQuantity(): int
    {
        return intval($this->quantity);
    }

    public function stockDate(): string
    {
        return $this->date;
    }

    public function stockNotes(): string
    {
        return $this->notes;
    }

    public function stockEnabled(): bool
    {
        return boolval($this->enabled);
    }
}
