<?php

declare(strict_types=1);

namespace src\frontoffice\Shared\Domain\ValueObjects;

use src\Shared\Domain\ValueObject\IntValueObject;

final class StockPhysicalQuantity extends IntValueObject
{
    /*public function __construct(protected int $value)
    {
        parent::__construct($value);

        $this->validateGreaterThanZero();
    }

    protected function validateGreaterThanZero(): void
    {
        if ($this->value < 0) {
            throw new \InvalidArgumentException('La cantidad debe ser mayor a cero.');
        }
    }*/
}
