<?php

declare(strict_types = 1);

namespace src\frontoffice\Home\Domain;

use src\Shared\Domain\DomainError;

final class HomeProductNotExist extends DomainError
{
    private $id;

    public function __construct($id)
    {
        $this->id = $id;

        parent::__construct();
    }

    public function errorCode(): string
    {
        return 'product_not_exist';
    }

    protected function errorMessage(): string
    {
        return sprintf('El producto con el código %s no existe', $this->id);
    }
}
