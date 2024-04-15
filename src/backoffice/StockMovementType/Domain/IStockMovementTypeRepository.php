<?php

namespace src\backoffice\StockMovementType\Domain;


interface IStockMovementTypeRepository
{
    public function searchAll(): ?array;

    public function getAllEnabledStockMovementTypesNamesAndIDs(): ?array;

    public function search($id): ?array;

    public function save(StockMovementType $stockMovementType): void;

    public function update($id, StockMovementType $stockMovementType): void;
    
    public function delete($id): void;

}
