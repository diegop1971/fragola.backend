<?php

declare(strict_types=1);

namespace src\backoffice\StockMovementType\Infrastructure\Persistence\Eloquent;

use src\backoffice\StockMovementType\Domain\StockMovementType;
use src\backoffice\StockMovementType\Domain\StockMovementTypeNotExist;
use src\backoffice\StockMovementType\Domain\StockMovementTypeRepository;
use src\backoffice\StockMovementType\Infrastructure\Persistence\Eloquent\EloquentStockMovementTypeModel;

class EloquentStockMovementTypeRepository implements StockMovementTypeRepository
{
    public function searchAll(): ?array
    {                
        $stockMovementTypes = EloquentStockMovementTypeModel::all();
                                
        if ($stockMovementTypes->isEmpty()) {

            return  $stockMovementTypes = [];
        }

        return $stockMovementTypes->toArray();
    }

    public function search($id): ?array
    {
        $model = EloquentStockMovementTypeModel::find($id);

        if (null === $model) {
            return null;
        }

        return $model->toArray();
    }

    public function save(StockMovementType $stockMovementType): void
    {
        $model = new EloquentStockMovementTypeModel();

        $model->id = $stockMovementType->stockMovementTypeId()->value();
        $model->movement_type_name = $stockMovementType->stockMovementTypeName()->value();
        $model->notes = $stockMovementType->stockMovementTypeNotes()->value();
        $model->enabled = $stockMovementType->stockMovementTypeEnabled()->value();

        $model->save();
    }
    
    public function update($id, StockMovementType $stockMovementType): void
    {
        $model = EloquentStockMovementTypeModel::find($id);

        $model->id = $stockMovementType->stockMovementTypeId()->value();
        $model->movement_type_name = $stockMovementType->stockMovementTypeName()->value();
        $model->notes = $stockMovementType->stockMovementTypeNotes()->value();
        $model->enabled = $stockMovementType->stockMovementTypeEnabled()->value();

        $model->update();
    }
    
    public function delete($id): void
    {
        $model = EloquentStockMovementTypeModel::find($id);
        
        if (null === $model) {
            throw new StockMovementTypeNotExist($id);
        }

        $model->delete();
    }
}
