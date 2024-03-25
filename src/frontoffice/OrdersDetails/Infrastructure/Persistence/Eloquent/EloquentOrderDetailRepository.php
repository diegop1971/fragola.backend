<?php

declare(strict_types=1);

namespace src\frontoffice\OrdersDetails\Infrastructure\Persistence\Eloquent;

use src\frontoffice\OrdersDetails\Domain\OrderDetailEntity;
use src\frontoffice\OrdersDetails\Domain\Interfaces\IOrderDetailRepository;
use src\frontoffice\OrdersDetails\Infrastructure\Persistence\Eloquent\OrderDetailEloquentModel;

class EloquentOrderDetailRepository implements IOrderDetailRepository
{
    public function searchAll(): ?array
    {
        $orderDetail = OrderDetailEloquentModel::paginate(10);

        if ($orderDetail->isEmpty()) {
            return [];
        }

        return $orderDetail->toArray();
    }

    public function search($id): ?array
    {
        $orderDetail = OrderDetailEloquentModel::where('id', '=', $id)->first();

        if (null === $orderDetail) {
            return null;
        }

        return $orderDetail->toArray();
    }

    public function insert(OrderDetailEntity $orderDetail): void
    {
        $model = new OrderDetailEloquentModel();

        $model->id = $orderDetail->orderDetailId()->value();
        $model->order_id = $orderDetail->orderOrderId()->value();
        $model->product_id = $orderDetail->orderDetailProductId()->value();
        $model->quantity = $orderDetail->orderDetailQuantity()->value();
        $model->unit_price = $orderDetail->orderDetailUnitPrice()->value();

        $model->save();
    }
}
