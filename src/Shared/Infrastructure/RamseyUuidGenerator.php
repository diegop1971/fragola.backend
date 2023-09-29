<?php

declare(strict_types = 1);

namespace src\Shared\Infrastructure;

use Ramsey\Uuid\Uuid;
use src\Shared\Domain\UuidGenerator;

final class RamseyUuidGenerator implements UuidGenerator
{
    public function generate(): string
    {
        return Uuid::uuid4()->toString();
    }
}
