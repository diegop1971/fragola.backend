<?php

declare(strict_types=1);

namespace src\frontoffice\Categories\Application\Find;


use src\frontoffice\Categories\Domain\CategoryNotExist;
use src\frontoffice\Categories\Domain\CategoryRepository;

final class CategoryFinder
{
    private $repository;

    public function __construct(CategoryRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke($id): ?array
    {
        $category = $this->repository->search($id);

        if (null === $category) {
            throw new CategoryNotExist($id);
        }
        
        return $category;
    }
}
