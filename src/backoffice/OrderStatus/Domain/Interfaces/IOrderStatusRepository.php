<?php

namespace src\backoffice\OrderStatus\Domain\Interfaces;

interface IOrderStatusRepository
{
    public function searchAll(): ?array;
}
