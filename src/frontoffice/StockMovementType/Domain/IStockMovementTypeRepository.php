<?php

namespace src\frontoffice\StockMovementType\Domain;


interface IStockMovementTypeRepository
{
    public function search($id): ?array;
    
    public function searchByShortName($shortName): ?string;
}
