<?php

namespace src\backoffice\Shared\Domain\Providers;

use Illuminate\Support\ServiceProvider;
use src\backoffice\Shared\Domain\Services\BackOfficeErrorMappingService;
use src\backoffice\Shared\Domain\Interfaces\IBackOfficeErrorMappingService;


class BackOfficeSharedServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
      $this->app->bind(
        IBackOfficeErrorMappingService::class,
        BackOfficeErrorMappingService::class
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
