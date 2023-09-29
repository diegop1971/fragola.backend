<?php

declare(strict_types = 1);

namespace src\backoffice\Stock\Domain;

use src\Shared\Domain\DomainError;


final class StockNotExist extends DomainError
{
    private $id;

    public function __construct($id)
    {
        $this->id = $id;

        parent::__construct();
    }

    public function errorCode(): string
    {
        return 'stock_not_exist';
    }

    protected function errorMessage(): string
    {
        return sprintf('El movimiento de stock con el código %s no existe en el stock', $this->id);
    }
}
