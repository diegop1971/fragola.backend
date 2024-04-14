<?php

declare(strict_types=1);

namespace src\frontoffice\StockMovements\Domain;

use src\frontoffice\StockMovements\Domain\ValueObjects\StockId;
use src\backoffice\Stock\Domain\ValueObjects\SystemStockQuantity;
use src\frontoffice\StockMovements\Domain\ValueObjects\StockDate;
use src\frontoffice\StockMovements\Domain\ValueObjects\StockNotes;
use src\backoffice\Stock\Domain\ValueObjects\PhysicalStockQuantity;
use src\frontoffice\StockMovements\Domain\ValueObjects\StockEnabled;
use src\frontoffice\StockMovements\Domain\ValueObjects\StockProductId;
use src\frontoffice\StockMovements\Domain\ValueObjects\StockMovementTypeId;


final class StockMovement
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

    public function physicalStockQuantity(): PhysicalStockQuantity
    {
        return $this->physicalStockQuantity;
    }

    public function systemStockQuantityAbsolute(): int
    {
        return abs($this->systemStockQuantity->value());
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
