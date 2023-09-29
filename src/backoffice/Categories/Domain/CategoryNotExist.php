<?php

declare(strict_types = 1);

namespace src\backoffice\Categories\Domain;

use src\Shared\Domain\DomainError;

final class CategoryNotExist extends DomainError
{
    private $id;

    public function __construct($id)
    {
        $this->id = $id;

        parent::__construct();
    }

    public function errorCode(): string
    {
        return 'category_not_exist';
    }

    protected function errorMessage(): string
    {
        return sprintf('La categoria con el código %s no existe', $this->id);
    }
}
