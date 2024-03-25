<?php

namespace src\frontoffice\OrdersDetails\Domain\Interfaces;

use src\frontoffice\OrdersDetails\Domain\OrderDetailEntity;

interface IOrderDetailRepository
{
    public function searchAll(): ?array;

    public function search($id): ?array;

    public function insert(OrderDetailEntity $orderDetailEntity): void;
}
