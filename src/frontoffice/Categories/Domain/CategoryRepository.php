<?php

namespace src\frontoffice\Categories\Domain;

interface CategoryRepository
{
    public function searchAll(): ?array;

    public function search($id): ?array;

    public function getEnabledCategories(): ?array;
}
