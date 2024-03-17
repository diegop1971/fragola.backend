<?php

declare(strict_types=1);

namespace src\frontoffice\OrderStatus\Infrastructure\Persistence\Eloquent;

use src\frontoffice\OrderStatus\Domain\Interfaces\IOrderStatusRepository;
use src\frontoffice\OrderStatus\Infrastructure\Persistence\Eloquent\OrderStatusEloquentModel;

class EloquentOrderStatusRepository implements IOrderStatusRepository
{
    public function searchAll(): ?array
    {
        $orderStatus = OrderStatusEloquentModel::where('enabled', true)->get();

        if ($orderStatus->isEmpty()) {
            return [];
        }

        return $orderStatus->toArray();
    }

    public function search($id): ?array
    {
        $orderStatus = OrderStatusEloquentModel::where('id', '=', $id)->first();

        if (null === $orderStatus) {
            return null;
        }

        return $orderStatus->toArray();
    }

    public function searchByShortName($shortName): ?array
    {
        $orderStatus = OrderStatusEloquentModel::select('id', 'name')
            ->where('short_name', '=', $shortName)
            ->first();

        if (null === $orderStatus) {
            return null;
        }

        return $orderStatus->toArray();
    }
}
