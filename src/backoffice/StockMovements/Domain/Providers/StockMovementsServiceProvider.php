<?php
namespace src\backoffice\StockMovements\Domain\Providers;

use src\Shared\Domain\UuidGenerator;
use Illuminate\Support\ServiceProvider;
use src\Shared\Domain\Bus\Command\Container;
use src\Shared\Domain\Bus\Command\CommandBus;
use src\Shared\Infrastructure\LaravelContainer;
use src\Shared\Infrastructure\RamseyUuidGenerator;
use src\Shared\Infrastructure\Bus\Command\SimpleCommandBus;
use src\backoffice\StockMovements\Domain\Services\StockUpdaterService;
use src\backoffice\StockMovementType\Domain\StockMovementTypeRepository;
use src\backoffice\StockMovements\Domain\Services\StockAvailabilityService;
use src\backoffice\StockMovements\Domain\Interfaces\IStockMovementsRepository;
use src\backoffice\StockMovements\Domain\Interfaces\StockUpdaterServiceInterface;
use src\backoffice\StockMovements\Domain\Services\StockMovementTypeCheckerService;
use src\backoffice\StockMovements\Domain\Services\StockMovementTypeFetcherService;
use src\backoffice\StockMovements\Domain\Services\StockQuantitySignHandlerService;
use src\backoffice\StockMovements\Domain\Interfaces\IStockMovementTypeFetcherService;
use src\backoffice\StockMovements\Domain\Interfaces\StockAvailabilityServiceInterface;
use src\backoffice\StockMovements\Domain\Interfaces\StockMovementTypeCheckerServiceInterface;
use src\backoffice\StockMovements\Domain\Interfaces\StockQuantitySignHandlerServiceInterface;
use src\backoffice\StockMovements\Domain\Services\StockValidateQuantityGreaterThanZeroService;
use src\backoffice\StockMovements\Infrastructure\Persistence\Eloquent\EloquentStockMovementsRepository;
use src\backoffice\StockMovements\Domain\Interfaces\StockValidateQuantityGreaterThanZeroServiceInterface;
use src\backoffice\StockMovementType\Infrastructure\Persistence\Eloquent\EloquentStockMovementTypeRepository;

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
        IStockMovementsRepository::class, 
        EloquentStockMovementsRepository::class
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
        IStockMovementTypeFetcherService::class, 
        StockMovementTypeFetcherService::class
      );

      $this->app->bind(
        StockAvailabilityServiceInterface::class, 
        StockAvailabilityService::class
      );

      $this->app->bind(
        StockUpdaterServiceInterface::class, 
        StockUpdaterService::class
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