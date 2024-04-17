<?php

declare(strict_types=1);

namespace src\backoffice\Stock\Domain;

use src\backoffice\Shared\Domain\Stock\StockId;
use src\backoffice\Shared\Domain\Stock\StockProductId;
use src\backoffice\Shared\Domain\Stock\StockSystemStockQuantity;
use src\backoffice\Shared\Domain\Stock\StockPhysicalStockQuantity;

final class Stock
{
    public function __construct(
        private StockId $stockId,
        private StockProductId $stockProductId,
        private StockSystemStockQuantity $stockSystemStockQuantity,
        private StockPhysicalStockQuantity $stockPhysicalStockQuantity,
    ) {
    }

    public static function create(
        StockId $stockId,
        StockProductId $stockProductId,
        StockSystemStockQuantity $stockSystemStockQuantity,
        StockPhysicalStockQuantity $stockPhysicalStockQuantity,
    ): self {
        $stock = new self(
            $stockId,
            $stockProductId,
            $stockSystemStockQuantity,
            $stockPhysicalStockQuantity,
        );

        return $stock;
    }

    public static function update(
        StockId $stockId,
        StockProductId $stockProductId,
        StockSystemStockQuantity $stockSystemStockQuantity,
        StockPhysicalStockQuantity $stockPhysicalStockQuantity,
    ): self {
        $stock = new self(
            $stockId,
            $stockProductId,
            $stockSystemStockQuantity,
            $stockPhysicalStockQuantity,
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

    public function stockPhysicalStockQuantity(): StockPhysicalStockQuantity
    {
        return $this->stockPhysicalStockQuantity;
    }

    public function stockSystemStockQuantity(): StockSystemStockQuantity
    {
        return $this->stockSystemStockQuantity;
    }

    public function stockPhysicalStockQuantityAbsolute(): int
    {
        return abs($this->stockPhysicalStockQuantity->value());
    }

    public function stockSystemStockQuantityAbsolute(): int
    {
        return abs($this->stockSystemStockQuantity->value());
    }
}
