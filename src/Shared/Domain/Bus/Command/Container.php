<?php

declare(strict_types = 1);

namespace src\Shared\Domain\Bus\Command;

interface Container
{
    public function make($class);
}
