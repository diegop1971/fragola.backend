<?php

declare(strict_types=1);

namespace src\backoffice\Categories\Domain;

use src\backoffice\Categories\Domain\CategoryId;
use src\backoffice\Categories\Domain\CategoryName;
use src\backoffice\Categories\Domain\CategoryEnabled;

final class Category
{
    public function __construct(
        private CategoryId $id,
        private CategoryName $name,
        private readonly CategoryEnabled $enabled,
    ) {
    }

    public static function create(
                                CategoryId $id, 
                                CategoryName $name, 
                                CategoryEnabled $enabled
                            ): self
    {
        $category = new self($id, $name, $enabled);

        return $category;
    }

    public static function update(
                                CategoryId $id, 
                                CategoryName $name,
                                CategoryEnabled $enabled
                            ): self
    {
        $category = new self($id, $name, $enabled);

        return $category;
    }

    public function Id(): CategoryId
    {
        return $this->id;
    }

    public function categoryName(): CategoryName
    {
        return $this->name;
    }

    public function categoryEnabled(): CategoryEnabled
    {
        return $this->enabled;
    }
}
