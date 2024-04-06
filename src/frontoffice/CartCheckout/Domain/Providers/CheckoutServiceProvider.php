<?php
namespace src\frontoffice\CartCheckout\Domain\Providers;

use src\Shared\Domain\UuidGenerator;
use Illuminate\Support\ServiceProvider;
use src\Shared\Domain\Bus\Command\Container;
use src\Shared\Domain\Bus\Command\CommandBus;
use src\Shared\Infrastructure\LaravelContainer;
use src\Shared\Infrastructure\RamseyUuidGenerator;
use src\Shared\Infrastructure\Bus\Command\SimpleCommandBus;
use src\frontoffice\CartCheckout\Domain\Interfaces\IPaymentGateway;
use src\frontoffice\CartCheckout\Domain\Services\DeleteCartService;
use src\frontoffice\CartCheckout\Domain\Interfaces\IDeleteCartService;
use src\frontoffice\CartCheckout\Domain\Services\PaymentMethodsHandlerService;


class CheckoutServiceProvider extends ServiceProvider
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
        IDeleteCartService::class, 
        DeleteCartService::class
      );

      /*$this->app->bind(
        IPaymentGateway::class, 
        PaymentMethodsHandlerService::class
      );*/
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
