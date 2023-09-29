<?php

declare(strict_types=1);

namespace src\frontoffice\Categories\Application\Find;

use src\frontoffice\Categories\Domain\CategoryRepository;

final class CategoriesGet
{
    private $repository;

    public function __construct(CategoryRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(): array
    {
        $categories = $this->repository->searchAll();
        
        return $categories;
    }
}
