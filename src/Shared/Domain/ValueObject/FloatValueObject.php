<?php

declare(strict_types=1);

namespace src\Shared\Domain\ValueObject;

abstract class FloatValueObject
{
    public function __construct(protected float $value)
    {
        $this->validate();
    }

    public function value(): float
    {
        return $this->value;
    }

    public function isEqualTo(self $other): bool
    {
        return $this->value() === $other->value();
    }

    public function isGreaterThan(self $other): bool
    {
        return $this->value() > $other->value();
    }

    public function isGreaterThanOrEqualTo(self $other): bool
    {
        return $this->value() >= $other->value();
    }

    public function isLessThan(self $other): bool
    {
        return $this->value() < $other->value();
    }

    public function isLessThanOrEqualTo(self $other): bool
    {
        return $this->value() <= $other->value();
    }

    protected function validate(): void
    {
        // Implementar validaciones específicas aquí
        // y lanzar una excepción si el valor no cumple ciertas reglas de negocio
    }
}
