<?php

declare(strict_types=1);

namespace src\Shared\Infrastructure\Bus\Command;

use src\Shared\Domain\Bus\Command\Command;
use src\Shared\Domain\Bus\Command\CommandBus;
use src\Shared\Domain\Bus\Command\Container;

final class SimpleCommandBus implements CommandBus
{
    private const COMMAND_PREFIX = 'Command';
    private const HANDLER_PREFIX = 'CommandHandler';

    private $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function execute($command)
    {
        return $this->resolveHandler($command)->__invoke($command);
    }

    private function resolveHandler(Command $command)
    {
        return $this->container->make($this->getHandlerClass($command));
    }

    public function getHandlerClass(Command $command): string
    {
        return str_replace(
            self::COMMAND_PREFIX,
            self::HANDLER_PREFIX,
            get_class($command)
        );
    }
}
