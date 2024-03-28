<?php

declare(strict_types=1);

namespace src\Shared\Domain\ValueObject;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class PasswordValueObject
{
    private string $value;

    public function __construct($value)
    { 
        $this->value = $value;
    }

    public static function random(): self
    {
        $hashedValue = Hash::make(Str::random(8));
        return new static($hashedValue);
    }

    public function value(): string
    {    
        return $this->value;
    }
}
