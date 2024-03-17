<?php

namespace src\frontoffice\Orders\Domain\Interfaces;

interface IOrderRepository
{
    public function searchAll(): ?array;

    public function search($id): ?array;
}
