<?php

declare(strict_types=1);

namespace src\Shared\Domain\ValueObject;

abstract class BoolValueObject
{
    public function __construct(protected bool $value)
    {
    }

    public function value(): bool
    {
        return $this->value;
    }

    public function isTrue(): bool
    {
        return $this->value === true;
    }

    public function isFalse(): bool
    {
        return $this->value === false;
    }

    public function toggle(): self
    {
        return new static(!$this->value);
    }

    public function isEqualTo(self $other): bool
    {
        return $this->value === $other->value();
    }

    public function __toString(): string
    {
        return $this->value ? 'true' : 'false';
    }
}
