<?php

namespace src\frontoffice\Home\Domain\Interfaces;

interface HomeProductsRepositoryInterface
{
    public function getHomeProducts(): ?array;

    public function search($id): ?array;
}
