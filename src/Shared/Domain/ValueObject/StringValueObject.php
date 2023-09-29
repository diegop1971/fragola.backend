<?php

declare(strict_types=1);

namespace src\Shared\Domain\ValueObject;

abstract class StringValueObject
{
    public function __construct(protected string $value)
    {
        $this->validate();
    }

    public function value(): string
    {
        return $this->value;
    }

    public function length(): int
    {
        return strlen($this->value);
    }

    public function isEmpty(): bool
    {
        return $this->value === '';
    }

    public function isEqualTo(self $other): bool
    {
        return $this->value === $other->value();
    }

    public function startsWith(string $prefix): bool
    {
        return strpos($this->value, $prefix) === 0;
    }

    public function endsWith(string $suffix): bool
    {
        return substr($this->value, -strlen($suffix)) === $suffix;
    }

    public function contains(string $substring): bool
    {
        return strpos($this->value, $substring) !== false;
    }

    protected function validate(): void
    {
        // Implementar de ser necesario validaciones específicas aquí y 
        // lanzar una excepción si el valor no cumple ciertas reglas de negocio
    }
}

