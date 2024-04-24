<?php

namespace src\backoffice\OrderManager\Domain\Interfaces;

use src\frontoffice\Orders\Domain\Order;

interface IOrderManagerRepository
{
    public function searchAll(): ?array;
}
