<?php

declare(strict_types=1);

namespace src\frontoffice\StockMovements\Domain;

use src\frontoffice\Shared\Domain\Stock\StockId;
use src\frontoffice\Shared\Domain\Stock\StockProductId;
use src\frontoffice\Shared\Domain\Stock\StockSystemStockQuantity;
use src\frontoffice\StockMovements\Domain\ValueObjects\StockDate;
use src\frontoffice\Shared\Domain\Stock\StockPhysicalStockQuantity;
use src\frontoffice\StockMovements\Domain\ValueObjects\StockEnabled;
use src\frontoffice\StockMovements\Domain\ValueObjects\StockMovementsNotes;
use src\frontoffice\StockMovements\Domain\ValueObjects\StockMovementTypeId;

final class StockMovement
{
    public function __construct(
        private StockId $stockId,
        private StockProductId $stockProductId,
        private StockMovementTypeId $stockMovementTypeId,
        private StockSystemStockQuantity $stockSystemStockQuantity,
        private StockPhysicalStockQuantity $stockPhysicalStockQuantity,
        private StockDate $stockDate,
        private StockMovementsNotes $stockMovementsNotes,
        private StockEnabled $stockEnabled,
    ) {
    }

    public static function create(
        StockId $stockId,
        StockProductId $stockProductId,
        StockMovementTypeId $stockMovementTypeId,
        StockSystemStockQuantity $stockSystemStockQuantity,
        StockPhysicalStockQuantity $stockPhysicalStockQuantity,
        StockDate $stockDate,
        StockMovementsNotes $stockMovementsNotes,
        StockEnabled $stockEnabled,
    ): self {
        $stock = new self(
            $stockId,
            $stockProductId,
            $stockMovementTypeId,
            $stockSystemStockQuantity,
            $stockPhysicalStockQuantity,
            $stockDate,
            $stockMovementsNotes,
            $stockEnabled,
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

    public function stockSystemStockQuantity(): StockSystemStockQuantity
    {
        return $this->stockSystemStockQuantity;
    }

    public function stockPhysicalStockQuantity(): StockPhysicalStockQuantity
    {
        return $this->stockPhysicalStockQuantity;
    }

    public function stockSystemStockQuantityAbsolute(): int
    {
        return abs($this->stockSystemStockQuantity->value());
    }

    public function stockDate(): StockDate
    {
        return $this->stockDate;
    }

    public function stockMovementsNotes(): StockMovementsNotes
    {
        return $this->stockMovementsNotes;
    }

    public function stockEnabled(): StockEnabled
    {
        return $this->stockEnabled;
    }
}
