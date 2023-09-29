<?php

declare(strict_types=1);

namespace src\Shared\Domain;

interface UuidGenerator
{
    public function generate(): string;
}
