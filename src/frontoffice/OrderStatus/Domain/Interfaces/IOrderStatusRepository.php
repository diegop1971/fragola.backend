<?php

namespace src\frontoffice\OrderStatus\Domain\Interfaces;

interface IOrderStatusRepository
{
    public function searchAll(): ?array;

    public function search($id): ?array;

    public function searchByShortName($shortName): ?array;
}
