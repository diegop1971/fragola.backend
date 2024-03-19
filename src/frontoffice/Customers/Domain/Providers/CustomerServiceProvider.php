<?php

namespace src\frontoffice\Customers\Domain\Providers;

use src\Shared\Domain\UuidGenerator;
use Illuminate\Support\ServiceProvider;
use src\Shared\Domain\Bus\Command\Container;
use src\Shared\Domain\Bus\Command\CommandBus;
use src\Shared\Infrastructure\LaravelContainer;
use src\Shared\Infrastructure\RamseyUuidGenerator;
use src\Shared\Infrastructure\Bus\Command\SimpleCommandBus;
use src\frontoffice\Customers\Domain\Interfaces\ICustomerRepository;
use src\frontoffice\Customers\Infrastructure\Persistence\Eloquent\EloquentCustomerRepository;

class CustomerServiceProvider extends ServiceProvider
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
      ICustomerRepository::class,
      EloquentCustomerRepository::class
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
