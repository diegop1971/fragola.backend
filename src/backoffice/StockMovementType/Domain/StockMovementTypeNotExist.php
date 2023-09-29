<?php

declare(strict_types = 1);

namespace src\backoffice\StockMovementType\Domain;

use src\Shared\Domain\DomainError;


final class StockMovementTypeNotExist extends DomainError
{
    private $id;

    public function __construct($id)
    {
        $this->id = $id;

        parent::__construct();
    }

    public function errorCode(): string
    {
        return 'stock_movement_type_not_exist';
    }

    protected function errorMessage(): string
    {
        return sprintf('El tipo de movimiento de stock con el código %s no existe', $this->id);
    }
}
