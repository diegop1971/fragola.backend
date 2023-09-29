<?php

namespace src\backoffice\StockMovementType\Domain;


interface StockMovementTypeRepository
{
    public function searchAll(): ?array;

    public function search($id): ?array;

    public function save(StockMovementType $stockMovementType): void;

    public function update($id, StockMovementType $stockMovementType): void;
    
    public function delete($id): void;

}
