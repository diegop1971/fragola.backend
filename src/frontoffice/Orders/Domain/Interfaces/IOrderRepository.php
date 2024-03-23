<?php

namespace src\frontoffice\Orders\Domain\Interfaces;

use src\frontoffice\Orders\Domain\Order;

interface IOrderRepository
{
    public function searchAll(): ?array;

    public function search($id): ?array;

    public function save(Order $order): void;
}
