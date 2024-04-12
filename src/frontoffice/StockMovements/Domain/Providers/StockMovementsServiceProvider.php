<?php

namespace src\frontoffice\StockMovements\Domain\Providers;

use Illuminate\Support\ServiceProvider;
use src\Shared\Domain\Bus\Command\Container;
use src\Shared\Infrastructure\LaravelContainer;
use src\frontoffice\StockMovements\Domain\Services\StockAvailabilityService;
use src\frontoffice\StockMovements\Domain\Interfaces\IStockMovementRepository;
use src\frontoffice\StockMovements\Domain\Interfaces\IStockAvailabilityService;
use src\frontoffice\StockMovements\Infrastructure\Persistence\Eloquent\EloquentStockMovementsRepository;

class StockMovementsServiceProvider extends ServiceProvider
{
  /**
   * Register services.
   *
   * @return void
   */
  public function register()
  {
    $this->app->bind(
      Container::class,
      LaravelContainer::class
    );

    $this->app->bind(
      IStockMovementRepository::class,
      EloquentStockMovementsRepository::class
    );

    $this->app->bind(
      IStockAvailabilityService::class,
      StockAvailabilityService::class
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
