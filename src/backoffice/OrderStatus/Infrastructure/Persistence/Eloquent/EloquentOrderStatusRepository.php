<?php

declare(strict_types=1);

namespace src\backoffice\OrderStatus\Infrastructure\Persistence\Eloquent;

use src\backoffice\OrderStatus\Domain\Interfaces\IOrderStatusRepository;
use src\backoffice\OrderStatus\Infrastructure\Persistence\Eloquent\OrderStatusEloquentModel;

class EloquentOrderStatusRepository implements IOrderStatusRepository
{
    public function searchAll(): ?array
    {
        $orderStatus = OrderStatusEloquentModel::select('id', 'name', 'description')->orderBy('id')->get();

        if ($orderStatus->isEmpty()) {

            return  $orderStatus = [];
        }

        return $orderStatus->toArray();
    }
}
