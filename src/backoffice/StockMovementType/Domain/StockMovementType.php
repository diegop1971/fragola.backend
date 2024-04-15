<?php

declare(strict_types=1);

namespace src\backoffice\StockMovementType\Domain;

use src\backoffice\StockMovementType\Domain\StockMovementTypeName;
use src\backoffice\StockMovementType\Domain\StockMovementTypeNotes;
use src\backoffice\StockMovementType\Domain\StockMovementTypeEnabled;
use src\backoffice\Shared\Domain\StockMovementType\StockMovementTypeId;


final class StockMovementType
{
    public function __construct(
        private StockMovementTypeId $stockMovementTypeId,
        private StockMovementTypeName $stockMovementTypeName,
        private StockMovementTypeNotes $stockMovementTypeNotes,
        private StockMovementTypeEnabled $stockMovementTypeEnabled,
    ) {
    }

    public static function create(
        StockMovementTypeId $stockMovementTypeId,
        StockMovementTypeName $stockMovementTypeName,
        StockMovementTypeNotes $stockMovementTypeNotes,
        StockMovementTypeEnabled $stockMovementTypeEnabled,
    ): self {
        $stock = new self(
            $stockMovementTypeId,
            $stockMovementTypeName,
            $stockMovementTypeNotes,
            $stockMovementTypeEnabled,
        );

        return $stock;
    }

    public static function update(
        StockMovementTypeId $stockMovementTypeId,
        StockMovementTypeName $stockMovementTypeName,
        StockMovementTypeNotes $stockMovementTypeNotes,
        StockMovementTypeEnabled $stockMovementTypeEnabled,
    ): self {
        $stock = new self(
            $stockMovementTypeId,
            $stockMovementTypeName,
            $stockMovementTypeNotes,
            $stockMovementTypeEnabled,
        );

        return $stock;
    }

    public function stockMovementTypeId(): StockMovementTypeId
    {
        return $this->stockMovementTypeId;
    }

    public function stockMovementTypeName(): StockMovementTypeName
    {
        return $this->stockMovementTypeName;
    }

    public function stockMovementTypeNotes(): StockMovementTypeNotes
    {
        return $this->stockMovementTypeNotes;
    }

    public function stockMovementTypeEnabled(): StockMovementTypeEnabled
    {
        return $this->stockMovementTypeEnabled;
    }
}
