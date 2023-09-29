<?php

declare(strict_types=1);

namespace src\backoffice\Categories\Application\Delete;

use src\backoffice\Categories\Domain\CategoryRepository;

final class CategoryDeleter
{
    private $repository;

    public function __construct(CategoryRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $id)
    {
        $this->repository->delete($id);
    }
}
