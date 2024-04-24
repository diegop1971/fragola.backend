<?php

namespace src\backoffice\OrderManager\Domain\Providers;

use src\Shared\Domain\UuidGenerator;
use Illuminate\Support\ServiceProvider;
use src\Shared\Domain\Bus\Command\Container;
use src\Shared\Domain\Bus\Command\CommandBus;
use src\Shared\Infrastructure\LaravelContainer;
use src\Shared\Infrastructure\RamseyUuidGenerator;
use src\Shared\Infrastructure\Bus\Command\SimpleCommandBus;
use src\backoffice\OrderManager\Domain\Interfaces\IOrderManagerRepository;
use src\backoffice\OrderManager\Infrastructure\Persistence\Eloquent\EloquentOrderRepository;

class OrderManagerServiceProvider extends ServiceProvider
{
  /**
   * Register services.
   *
   * @return void
   */
  public function register()
  {
    $this->app->bind(
      CommandBus::class,
      SimpleCommandBus::class
    );

    $this->app->bind(
      Container::class,
      LaravelContainer::class
    );

    $this->app->bind(
      UuidGenerator::class,
      RamseyUuidGenerator::class
    );

    $this->app->bind(
      IOrderManagerRepository::class,
      EloquentOrderRepository::class
    );
  }

  /**
   * Bootstrap services.
   *
   * @return void
   */
  public function boot()
  {
  }
}
