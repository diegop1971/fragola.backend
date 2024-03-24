<?php

namespace src\frontoffice\OrdersDetails\Domain\Interfaces;

use src\frontoffice\Orders\Domain\Order;

interface IOrderDetailRepository
{
    public function searchAll(): ?array;

    public function search($id): ?array;

    public function save(Order $order): void;
}
