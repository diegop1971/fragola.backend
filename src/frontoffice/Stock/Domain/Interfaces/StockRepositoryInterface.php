<?php

namespace src\frontoffice\Stock\Domain\Interfaces;

interface StockRepositoryInterface
{
    public function groupAndCountStockByProductId(): ?array;
}
