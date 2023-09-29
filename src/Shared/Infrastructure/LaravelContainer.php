<?php

declare(strict_types = 1);

namespace src\Shared\Infrastructure;

use Illuminate\Container\Container as IoC;
use src\Shared\Domain\Bus\Command\Container;

class LaravelContainer implements Container
{
    private $container;

    public function __construct(IoC $container)
    {
        $this->container = $container;
    }

    public function make($class)
    {
        return $this->container->make($class);
    }
}
