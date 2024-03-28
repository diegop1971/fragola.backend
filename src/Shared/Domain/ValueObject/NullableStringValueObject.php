<?php

namespace src\Shared\Domain\ValueObject;

class NullableStringValueObject
{
    private $value;

    public function __construct(?string $value)
    {
        if ($value !== null && !is_string($value)) {
            throw new \InvalidArgumentException("Value must be a string or null.");
        }

        $this->value = $value;
    }

    public function value(): ?string
    {
        return $this->value;
    }
}
