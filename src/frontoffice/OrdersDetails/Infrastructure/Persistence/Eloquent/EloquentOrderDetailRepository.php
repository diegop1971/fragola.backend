<?php

declare(strict_types=1);

namespace src\frontoffice\OrdersDetails\Infrastructure\Persistence\Eloquent;

use src\frontoffice\Orders\Domain\Order;
use src\frontoffice\Orders\Domain\Interfaces\IOrderRepository;
use src\frontoffice\Orders\Infrastructure\Persistence\Eloquent\OrderEloquentModel;

class EloquentOrderDetailRepository implements IOrderRepository
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

    public function save(Order $order): void
    {
        $model = new OrderEloquentModel();

        $model->id = $order->orderId()->value();
        $model->customer_id = $order->orderCustomerId()->value();
        $model->payment_method_id = $order->orderPaymentMethodId()->value();
        $model->order_status_id = $order->orderStatusId()->value();
        $model->items_quantity = $order->orderItemsQuantity()->value();
        $model->total_paid = $order->orderTotalPaid()->value();

        $model->save();
    }
}
