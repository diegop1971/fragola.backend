<?php

namespace src\frontoffice\OrdersDetails\Domain\Providers;

use src\Shared\Domain\UuidGenerator;
use Illuminate\Support\ServiceProvider;
use src\Shared\Domain\Bus\Command\Container;
use src\Shared\Domain\Bus\Command\CommandBus;
use src\Shared\Infrastructure\LaravelContainer;
use src\Shared\Infrastructure\RamseyUuidGenerator;
use src\Shared\Infrastructure\Bus\Command\SimpleCommandBus;
use src\frontoffice\OrdersDetails\Domain\Interfaces\IOrderDetailRepository;
use src\frontoffice\OrdersDetails\Infrastructure\Persistence\Eloquent\EloquentOrderDetailRepository;

class OrderDetailServiceProvider extends ServiceProvider
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
      IOrderDetailRepository::class,
      EloquentOrderDetailRepository::class
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
