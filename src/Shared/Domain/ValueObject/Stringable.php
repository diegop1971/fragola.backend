<?php

namespace src\Shared\Domain\ValueObject;

use Ramsey\Uuid\Uuid as RamseyUuid;

abstract class Stringable  
{
    public function __construct(protected string $value)
    {
        $this->ensureIsValidUuid($value);
    }

    abstract protected static function random(): self;

    abstract protected function value(): string;

    abstract protected function equals(Uuid $other): bool;

    abstract public function __toString(): string;

    private function ensureIsValidUuid(string $id): void
    {
        
    }
}
