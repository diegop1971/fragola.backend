<?php

declare(strict_types=1);

namespace src\frontoffice\Customers\Infrastructure\Persistence\Eloquent;

use src\frontoffice\Customers\Domain\Interfaces\ICustomerRepository;
use src\frontoffice\Customers\Infrastructure\Persistence\Eloquent\CustomerEloquentModel;

class EloquentCustomerRepository implements ICustomerRepository
{
    public function search($id): ?array
    {
        $model = CustomerEloquentModel::where('id', '=', $id)->first();

        if (null === $model) {
            return null;
        }

        return $model->toArray();
    }
}
