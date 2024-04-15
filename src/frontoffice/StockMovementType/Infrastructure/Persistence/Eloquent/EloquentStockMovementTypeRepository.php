<?php

declare(strict_types=1);

namespace src\frontoffice\StockMovementType\Infrastructure\Persistence\Eloquent;

use src\frontoffice\StockMovementType\Domain\IStockMovementTypeRepository;
use src\frontoffice\StockMovementType\Infrastructure\Persistence\Eloquent\EloquentStockMovementTypeModel;

class EloquentStockMovementTypeRepository implements IStockMovementTypeRepository
{
    public function search($id): ?array
    {
        $model = EloquentStockMovementTypeModel::find($id);

        if (null === $model) {
            return null;
        }

        return $model->toArray();
    }

    public function searchByShortName($shortName): ?string
    {
        $model = EloquentStockMovementTypeModel::where('short_name', $shortName)->first();

        if (null === $model) {
            return null;
        }

        return $model['id'];
    }
}
