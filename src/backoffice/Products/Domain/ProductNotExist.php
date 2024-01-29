<?php

declare(strict_types = 1);

namespace src\backoffice\Products\Domain;

use src\Shared\Domain\DomainException;

class ProductNotExist extends DomainException
{
    public function __construct($id) {
        parent::__construct(2001, sprintf('El producto con el código %s no existe', $id));
    }
}
