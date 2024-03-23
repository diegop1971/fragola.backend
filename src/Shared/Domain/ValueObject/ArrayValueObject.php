<?php

declare(strict_types=1);

namespace src\Shared\Domain\ValueObject;

abstract class ArrayValueObject
{
    public function __construct(protected array $value) {}

    final public function value(): array
    {
        return $this->value;
    }
}
