<?php

namespace src\frontoffice\Stock\Domain\Interfaces;

interface IStockRepository
{
    public function groupAndCountStockByProductId(): ?array;
}
