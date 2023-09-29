<?php

declare(strict_types = 1);

namespace src\Shared\Domain\Bus\Command;

use src\Shared\Domain\Bus\Command\Container;

interface CommandBus
{
    public function execute($command);
}
