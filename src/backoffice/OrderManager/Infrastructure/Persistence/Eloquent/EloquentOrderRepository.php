<?php

declare(strict_types=1);

namespace src\backoffice\OrderManager\Infrastructure\Persistence\Eloquent;

use src\backoffice\OrderManager\Domain\Interfaces\IOrderManagerRepository;
use src\frontoffice\Orders\Infrastructure\Persistence\Eloquent\OrderEloquentModel;

class EloquentOrderRepository implements IOrderManagerRepository
{
    public function searchAll(): ?array
    {
        $orders = OrderEloquentModel::join('customers', 'orders.customer_id', '=', 'customers.id')
            ->join('payment_methods', 'orders.payment_method_id', '=', 'payment_methods.id')
            ->join('order_status', 'orders.order_status_id', '=', 'order_status.id')
            ->select('orders.id', 'customers.first_name', 'customers.last_name', 'payment_methods.name as payment_method_name', 'order_status_id', 'order_status.name as order_status_name', 'orders.items_quantity', 'orders.total_paid', 'orders.created_at', 'orders.updated_at')
            ->get();

        if ($orders->isEmpty()) {
            return [];
        }

        return $orders->toArray();
    }
}
