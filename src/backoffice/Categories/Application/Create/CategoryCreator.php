<?php

declare(strict_types=1);

namespace src\backoffice\Categories\Application\Create;

use src\backoffice\Categories\Domain\Category;
use src\backoffice\Categories\Domain\CategoryId;
use src\backoffice\Categories\Domain\CategoryName;
use src\backoffice\Categories\Domain\CategoryEnabled;
use src\backoffice\Categories\Domain\CategoryRepository;

final class CategoryCreator
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
        $category = Category::create(
                                    $id, 
                                    $name,
                                    $enabled
                                );

        $this->repository->save($category);
    }
}
