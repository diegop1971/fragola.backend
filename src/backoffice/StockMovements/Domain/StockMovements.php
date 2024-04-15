<?php

declare(strict_types=1);

namespace src\backoffice\StockMovements\Domain;

use src\backoffice\Shared\Domain\Stock\StockId;
use src\backoffice\Shared\Domain\Stock\StockProductId;
use src\backoffice\Shared\Domain\Stock\StockSystemStockQuantity;
use src\backoffice\Shared\Domain\Stock\StockPhysicalStockQuantity;
use src\backoffice\Shared\Domain\StockMovementType\StockMovementTypeId;
use src\backoffice\StockMovements\Domain\ValueObjects\StockMovementsDate;
use src\backoffice\StockMovements\Domain\ValueObjects\StockMovementsNotes;
use src\backoffice\StockMovements\Domain\ValueObjects\StockMovementsEnabled;

final class StockMovements
{
    public function __construct(
        private StockId $stockId,
        private StockProductId $stockProductId,
        private StockMovementTypeId $stockMovementTypeId,
        private StockSystemStockQuantity $stockSystemStockQuantity,
        private StockPhysicalStockQuantity $stockPhysicalStockQuantity,
        private StockMovementsDate $stockMovementsDate,
        private StockMovementsNotes $stockMovementsNotes,
        private StockMovementsEnabled $stockMovementsEnabled,
    ) {
    }

    public static function create(
        StockId $stockId,
        StockProductId $stockProductId,
        StockMovementTypeId $stockMovementTypeId,
        StockSystemStockQuantity $stockSystemStockQuantity,
        StockPhysicalStockQuantity $stockPhysicalStockQuantity,
        StockMovementsDate $stockMovementsDate,
        StockMovementsNotes $stockMovementsNotes,
        StockMovementsEnabled $stockMovementsEnabled,
    ): self {
        $stock = new self(
            $stockId,
            $stockProductId,
            $stockMovementTypeId,
            $stockSystemStockQuantity,
            $stockPhysicalStockQuantity,
            $stockMovementsDate,
            $stockMovementsNotes,
            $stockMovementsEnabled,
        );

        return $stock;
    }

    public static function update(
        StockId $stockId,
        StockProductId $stockProductId,
        StockMovementTypeId $stockMovementTypeId,
        StockSystemStockQuantity $stockSystemStockQuantity,
        StockPhysicalStockQuantity $physicalStockQuantity,
        StockMovementsDate $stockMovementsDate,
        StockMovementsNotes $stockMovementsNotes,
        StockMovementsEnabled $stockMovementsEnabled,
    ): self {
        $stock = new self(
            $stockId,
            $stockProductId,
            $stockMovementTypeId,
            $stockSystemStockQuantity,
            $physicalStockQuantity,
            $stockMovementsDate,
            $stockMovementsNotes,
            $stockMovementsEnabled,
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

    public function stockSystemStockQuantityAbsolute(): int
    {
        return abs($this->stockSystemStockQuantity->value());
    }

    public function stockPhysicalStockQuantity(): StockPhysicalStockQuantity
    {
        return $this->stockPhysicalStockQuantity;
    }

    public function stockMovementsDate(): StockMovementsDate
    {
        return $this->stockMovementsDate;
    }

    public function stockMovementsNotes(): StockMovementsNotes
    {
        return $this->stockMovementsNotes;
    }

    public function stockMovementsEnabled(): StockMovementsEnabled
    {
        return $this->stockMovementsEnabled;
    }
}
