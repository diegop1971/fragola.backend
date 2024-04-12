<?php

namespace src\frontoffice\StockMovementType\Domain;


interface IStockMovementTypeRepository
{
    public function searchByShortName($shortName): ?string;
}
