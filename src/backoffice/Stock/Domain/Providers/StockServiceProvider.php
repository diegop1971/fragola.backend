<?php
namespace src\backoffice\Stock\Domain\Providers;

use src\Shared\Domain\SlugGenerator;
use src\Shared\Domain\UuidGenerator;
use Illuminate\Support\ServiceProvider;
use src\Shared\Domain\Bus\Command\Container;
use src\Shared\Domain\Bus\Command\CommandBus;
use src\Shared\Infrastructure\LaravelContainer;
use src\Shared\Infrastructure\RamseyUuidGenerator;
use src\Shared\Infrastructure\Bus\Command\SimpleCommandBus;
use src\backoffice\Stock\Domain\Services\StockAvailabilityService;
use src\backoffice\Stock\Domain\Interfaces\IStockRepository;
use src\backoffice\StockMovementType\Domain\StockMovementTypeRepository;
use src\backoffice\Stock\Domain\Services\StockMovementTypeCheckerService;
use src\backoffice\Stock\Domain\Services\StockQuantitySignHandlerService;
use src\backoffice\Stock\Domain\Interfaces\StockAvailabilityServiceInterface;
use src\backoffice\Stock\Domain\Interfaces\StockMovementTypeCheckerServiceInterface;
use src\backoffice\Stock\Domain\Interfaces\StockQuantitySignHandlerServiceInterface;
use src\backoffice\Stock\Domain\Services\StockValidateQuantityGreaterThanZeroService;
use src\backoffice\Stock\Infrastructure\Persistence\Eloquent\EloquentStockRepository;
use src\backoffice\Stock\Domain\Interfaces\StockValidateQuantityGreaterThanZeroServiceInterface;
use src\backoffice\StockMovementType\Infrastructure\Persistence\Eloquent\EloquentStockMovementTypeRepository;

class StockServiceProvider extends ServiceProvider
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
        IStockRepository::class, 
        EloquentStockRepository::class
      );

      $this->app->bind(
        StockMovementTypeRepository::class, 
        EloquentStockMovementTypeRepository::class
      );

      $this->app->bind(
        StockQuantitySignHandlerServiceInterface::class, 
        StockQuantitySignHandlerService::class
      );

      $this->app->bind(
        StockValidateQuantityGreaterThanZeroServiceInterface::class, 
        StockValidateQuantityGreaterThanZeroService::class
      );

      $this->app->bind(
        StockMovementTypeCheckerServiceInterface::class, 
        StockMovementTypeCheckerService::class
      );

      $this->app->bind(
        StockAvailabilityServiceInterface::class, 
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