<?php

namespace src\frontoffice\Home\Domain\Interfaces;

interface HomeProductsRepositoryInterface
{
    public function getHomeProducts();

    public function search($id): ?array;
}
