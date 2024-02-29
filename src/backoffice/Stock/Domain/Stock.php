<?php

declare(strict_types=1);

namespace src\backoffice\Stock\Domain;

use src\backoffice\Stock\Domain\ValueObjects\StockId;
use src\backoffice\Stock\Domain\ValueObjects\StockProductId;
use src\backoffice\Stock\Domain\ValueObjects\StockUsableQuantity;
use src\backoffice\Stock\Domain\ValueObjects\StockPhysicalQuantity;

final class Stock
{
    public function __construct(
        private StockId $stockId,
        private StockProductId $stockProductId,
        private StockPhysicalQuantity $stockPhysicalQuantity,
        private StockUsableQuantity $stockUsableQuantity,
    ) {
    }

    public static function create(
        StockId $stockId,
        StockProductId $stockProductId,
        StockPhysicalQuantity $stockPhysicalQuantity,
        StockUsableQuantity $stockUsableQuantity,
    ): self {
        $stock = new self(
            $stockId,
            $stockProductId,
            $stockPhysicalQuantity,
            $stockUsableQuantity,
        );

        return $stock;
    }

    public static function update(
        StockId $stockId,
        StockProductId $stockProductId,
        StockPhysicalQuantity $stockPhysicalQuantity,
        StockUsableQuantity $stockUsableQuantity,
    ): self {
        $stock = new self(
            $stockId,
            $stockProductId,
            $stockPhysicalQuantity,
            $stockUsableQuantity,
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

    public function stockPhysicalQuantity(): StockPhysicalQuantity
    {
        return $this->stockPhysicalQuantity;
    }

    public function stockUsableQuantity(): StockUsableQuantity
    {
        return $this->stockUsableQuantity;
    }

    public function stockPhysicalQuantityAbsolute(): int
    {
        return abs($this->stockPhysicalQuantity->value());
    }

    public function stockUsableQuantityAbsolute(): int
    {
        return abs($this->stockUsableQuantity->value());
    }
}
