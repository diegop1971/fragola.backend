<?php

declare(strict_types = 1);

namespace src\backoffice\OrderManager\Domain\ValueObjects;

use src\Shared\Domain\DomainException;

class OrderNotExist extends DomainException
{
    public function __construct($id) {
        parent::__construct(2001, sprintf('La orden con el código %s no existe', $id));
    }
}
