<?php
namespace src\backoffice\Products\Domain\Providers;

use src\Shared\Domain\UuidGenerator;
use Illuminate\Support\ServiceProvider;
use src\Shared\Domain\Bus\Command\Container;
use src\Shared\Domain\Bus\Command\CommandBus;
use src\Shared\Infrastructure\LaravelContainer;
use src\Shared\Infrastructure\RamseyUuidGenerator;
use src\backoffice\Products\Domain\IProductRepository;
use src\backoffice\Products\Domain\IProductFinderCommand;
use src\Shared\Infrastructure\Bus\Command\SimpleCommandBus;
use src\backoffice\Products\Application\Find\ProductFinderCommand;
use src\backoffice\Products\Domain\Interfaces\IValidateLowStockThresholdQuantity;
use src\backoffice\Products\Domain\Services\ValidateLowStockThresholdQuantityService;
use src\backoffice\Products\Infrastructure\Persistence\Eloquent\EloquentProductRepository;

class ProductServiceProvider extends ServiceProvider
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
        IProductRepository::class, 
        EloquentProductRepository::class
      );

      $this->app->bind(
        IProductFinderCommand::class,
        ProductFinderCommand::class
      );

      $this->app->bind(
        IValidateLowStockThresholdQuantity::class,
        ValidateLowStockThresholdQuantityService::class
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
