<?php

declare(strict_types=1);

namespace src\backoffice\StockMovements\Domain;

use src\backoffice\StockMovements\Domain\ValueObjects\StockId;
use src\backoffice\StockMovements\Domain\ValueObjects\StockDate;
use src\backoffice\StockMovements\Domain\ValueObjects\StockNotes;
use src\backoffice\StockMovements\Domain\ValueObjects\StockEnabled;
use src\backoffice\StockMovements\Domain\ValueObjects\StockQuantity;
use src\backoffice\StockMovements\Domain\ValueObjects\StockProductId;
use src\backoffice\StockMovements\Domain\ValueObjects\StockMovementTypeId;
use src\backoffice\Stock\Domain\ValueObjects\SystemStockQuantity;
use src\backoffice\Stock\Domain\ValueObjects\PhysicalStockQuantity;

final class StockMovements
{
    public function __construct(
        private StockId $stockId,
        private StockProductId $stockProductId,
        private StockMovementTypeId $stockMovementTypeId,
        private SystemStockQuantity $systemStockQuantity,
        private PhysicalStockQuantity $physicalStockQuantity,
        private StockDate $stockDate,
        private StockNotes $stockNotes,
        private StockEnabled $stockEnabled,
    ) {
    }

    public static function create(
        StockId $stockId,
        StockProductId $stockProductId,
        StockMovementTypeId $stockMovementTypeId,
        SystemStockQuantity $systemStockQuantity,
        PhysicalStockQuantity $physicalStockQuantity,
        StockDate $stockDate,
        StockNotes $stockNotes,
        StockEnabled $StockEnabled,
    ): self {
        $stock = new self(
            $stockId,
            $stockProductId,
            $stockMovementTypeId,
            $systemStockQuantity,
            $physicalStockQuantity,
            $stockDate,
            $stockNotes,
            $StockEnabled,
        );

        return $stock;
    }

    public static function update(
        StockId $stockId,
        StockProductId $stockProductId,
        StockMovementTypeId $stockMovementTypeId,
        SystemStockQuantity $systemStockQuantity,
        PhysicalStockQuantity $physicalStockQuantity,
        StockDate $stockDate,
        StockNotes $stockNotes,
        StockEnabled $StockEnabled,
    ): self {
        $stock = new self(
            $stockId,
            $stockProductId,
            $stockMovementTypeId,
            $systemStockQuantity,
            $physicalStockQuantity,
            $stockDate,
            $stockNotes,
            $StockEnabled,
        );

        return $stock;
    }

    public function stockId(): StockId
    {
        return $this->stockId;
    }

    public function stockProductId(): StockProductId
    {
        return $this->stockProductId;
    }

    public function stockMovementTypeId(): StockMovementTypeId
    {
        return $this->stockMovementTypeId;
    }

    public function systemStockQuantity(): SystemStockQuantity
    {
        return $this->systemStockQuantity;
    }

    public function systemStockQuantityAbsolute(): int
    {
        return abs($this->systemStockQuantity->value());
    }

    public function physicalStockQuantity(): PhysicalStockQuantity
    {
        return $this->physicalStockQuantity;
    }

    public function stockDate(): StockDate
    {
        return $this->stockDate;
    }

    public function stockNotes(): StockNotes
    {
        return $this->stockNotes;
    }

    public function stockEnabled(): StockEnabled
    {
        return $this->stockEnabled;
    }
}
