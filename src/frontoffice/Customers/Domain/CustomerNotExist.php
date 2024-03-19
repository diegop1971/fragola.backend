<?php

declare(strict_types = 1);

namespace src\frontoffice\Customers\Domain;

use src\Shared\Domain\DomainError;

final class CustomerNotExist extends DomainError
{
    private $id;

    public function __construct($id)
    {
        $this->id = $id;

        parent::__construct();
    }

    public function errorCode(): string
    {
        return 'customer_not_exist';
    }

    protected function errorMessage(): string
    {
        return sprintf('El customer con el id %s no existe', $this->id);
    }
}
