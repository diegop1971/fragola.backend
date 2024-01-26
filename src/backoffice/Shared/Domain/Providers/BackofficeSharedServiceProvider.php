<?php

namespace src\backoffice\Shared\Domain\Providers;

use Illuminate\Support\ServiceProvider;
use src\backoffice\Shared\Domain\Services\ErrorMappingService;
use src\backoffice\Shared\Domain\Interfaces\IErrorMappingService;

class BackofficeSharedServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
      $this->app->bind(
        IErrorMappingService::class,
        ErrorMappingService::class
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
