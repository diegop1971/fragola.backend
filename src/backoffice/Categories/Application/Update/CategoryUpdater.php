<?php

declare(strict_types=1);

namespace src\backoffice\Categories\Application\Update;

use src\backoffice\Categories\Domain\Category;
use src\backoffice\Categories\Domain\CategoryId;
use src\backoffice\Categories\Domain\CategoryName;
use src\backoffice\Categories\Domain\CategoryEnabled;
use src\backoffice\Categories\Domain\CategoryRepository;

final class CategoryUpdater
{
    public function __construct(private CategoryRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(
                            CategoryId $id, 
                            CategoryName $name, 
                            CategoryEnabled $enabled
                        )
    {
        $category = Category::update(
                                    $id, 
                                    $name, 
                                    $enabled
                                );

        $this->repository->update($category);
    }
}
