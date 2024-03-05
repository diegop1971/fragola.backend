<?php

namespace src\frontoffice\Shared\Domain\Providers;

use Illuminate\Support\ServiceProvider;
use src\frontoffice\Shared\Domain\Services\FrontOfficeErrorMappingService;
use src\frontoffice\Shared\Domain\Interfaces\IFrontOfficeErrorMappingService;

class FrontOfficeSharedServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
      $this->app->bind(
        IFrontOfficeErrorMappingService::class,
        FrontOfficeErrorMappingService::class
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
