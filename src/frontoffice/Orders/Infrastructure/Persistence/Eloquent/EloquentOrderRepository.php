<?php

declare(strict_types=1);

namespace src\frontoffice\Orders\Infrastructure\Persistence\Eloquent;

use src\frontoffice\Orders\Domain\Interfaces\IOrderRepository;
use src\frontoffice\Orders\Infrastructure\Persistence\Eloquent\OrderEloquentModel;

class EloquentOrderRepository implements IOrderRepository
{
    public function searchAll(): ?array
    {
        $orders = OrderEloquentModel::paginate(10);

        if ($orders->isEmpty()) {
            return [];
        }

        return $orders->toArray();
    }

    public function search($id): ?array
    {
        $order = OrderEloquentModel::where('id', '=', $id)->first();

        if (null === $order) {
            return null;
        }

        return $order->toArray();
    }
}
