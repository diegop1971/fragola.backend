<?php
namespace src\frontoffice\Home\Domain\Providers;

use src\Shared\Domain\SlugGenerator;
use Illuminate\Support\ServiceProvider;
use src\Shared\Domain\Bus\Command\Container;
use src\Shared\Domain\Bus\Command\CommandBus;
use src\Shared\Infrastructure\LaravelContainer;
use src\Shared\Infrastructure\CviebrockEloquentSluggable;
use src\Shared\Infrastructure\Bus\Command\SimpleCommandBus;
use src\frontoffice\Stock\Domain\Interfaces\StockRepositoryInterface;
use src\frontoffice\Home\Domain\Interfaces\HomeProductsRepositoryInterface;
use src\frontoffice\Stock\Infrastructure\Persistence\Eloquent\EloquentStockRepository;
use src\frontoffice\Home\Infrastructure\Persistence\Eloquent\HomeProductEloquentRepository;

class HomeProductServiceProvider extends ServiceProvider
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
        StockRepositoryInterface::class, 
        EloquentStockRepository::class
      );

      $this->app->bind(
        HomeProductsRepositoryInterface::class,
        HomeProductEloquentRepository::class
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
