<?php

namespace src\backoffice\Categories\Domain;

use src\backoffice\Categories\Domain\Category;

interface CategoryRepository
{
    public function searchAll(): ?array;

    public function search($id): ?array;

    public function save(Category $category): void;

    public function update(Category $category): void;
    
    public function delete($id): void;
}
