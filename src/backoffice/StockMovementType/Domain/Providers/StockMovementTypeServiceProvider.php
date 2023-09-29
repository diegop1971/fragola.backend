<?php
namespace src\backoffice\StockMovementType\Domain\Providers;

use src\Shared\Domain\SlugGenerator;
use Illuminate\Support\ServiceProvider;
use src\Shared\Domain\Bus\Command\Container;
use src\Shared\Domain\Bus\Command\CommandBus;
use src\Shared\Infrastructure\LaravelContainer;
use src\Shared\Infrastructure\CviebrockEloquentSluggable;
use src\Shared\Infrastructure\Bus\Command\SimpleCommandBus;
use src\backoffice\StockMovementType\Domain\StockMovementTypeRepository;
use src\backoffice\StockMovementType\Infrastructure\Persistence\Eloquent\EloquentStockMovementTypeRepository;

class StockMovementTypeServiceProvider extends ServiceProvider
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
        SlugGenerator::class,
        CviebrockEloquentSluggable::class
      );

      $this->app->bind(
        StockMovementTypeRepository::class, 
        EloquentStockMovementTypeRepository::class
        //RawSqlStockMovementTypeRepository::class
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
