<?php

declare(strict_types = 1);

namespace src\backoffice\Stock\Domain;

use src\Shared\Domain\DomainException;

final class StockNotExist extends DomainException
{
    public function __construct($id) {
        parent::__construct(2001, sprintf('El movimiento de stock con el código %s no existe', $id));
    }
}
