<?php

namespace src\frontoffice\Cart\Domain\Providers;

use Illuminate\Support\ServiceProvider;
use src\Shared\Domain\Bus\Command\Container;
use src\Shared\Domain\Bus\Command\CommandBus;
use src\Shared\Infrastructure\LaravelContainer;
use src\frontoffice\Cart\Domain\ICartSessionManager;
use src\frontoffice\Cart\Domain\Interfaces\ICartRepository;
use src\Shared\Infrastructure\Bus\Command\SimpleCommandBus;
use src\frontoffice\Cart\Infrastructure\Persistence\Session\CartRepository;
use src\frontoffice\Cart\Infrastructure\Persistence\Session\CartSessionCookieManager;

class CartSessionServiceProvider extends ServiceProvider
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
            ICartSessionManager::class,
            CartSessionCookieManager::class
        );

        $this->app->bind(
            ICartRepository::class,
            CartRepository::class
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
