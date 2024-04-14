<?php

declare(strict_types=1);

namespace src\backoffice\Stock\Domain;

use src\backoffice\Stock\Domain\ValueObjects\StockId;
use src\backoffice\Stock\Domain\ValueObjects\StockProductId;
use src\backoffice\Stock\Domain\ValueObjects\SystemStockQuantity;
use src\backoffice\Stock\Domain\ValueObjects\PhysicalStockQuantity;

final class Stock
{
    public function __construct(
        private StockId $stockId,
        private StockProductId $stockProductId,
        private PhysicalStockQuantity $physicalStockQuantity,
        private SystemStockQuantity $systemStockQuantity,
    ) {
    }

    public static function create(
        StockId $stockId,
        StockProductId $stockProductId,
        PhysicalStockQuantity $physicalStockQuantity,
        SystemStockQuantity $systemStockQuantity,
    ): self {
        $stock = new self(
            $stockId,
            $stockProductId,
            $physicalStockQuantity,
            $systemStockQuantity,
        );

        return $stock;
    }

    public static function update(
        StockId $stockId,
        StockProductId $stockProductId,
        PhysicalStockQuantity $physicalStockQuantity,
        SystemStockQuantity $systemStockQuantity,
    ): self {
        $stock = new self(
            $stockId,
            $stockProductId,
            $physicalStockQuantity,
            $systemStockQuantity,
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

    public function physicalStockQuantity(): PhysicalStockQuantity
    {
        return $this->physicalStockQuantity;
    }

    public function systemStockQuantity(): SystemStockQuantity
    {
        return $this->systemStockQuantity;
    }

    public function physicalStockQuantityAbsolute(): int
    {
        return abs($this->physicalStockQuantity->value());
    }

    public function systemStockQuantityAbsolute(): int
    {
        return abs($this->systemStockQuantity->value());
    }
}
