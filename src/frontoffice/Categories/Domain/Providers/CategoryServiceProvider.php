<?php

namespace src\frontoffice\Categories\Domain\Providers;

use src\Shared\Domain\SlugGenerator;
use src\Shared\Domain\UuidGenerator;
use Illuminate\Support\ServiceProvider;
use src\Shared\Domain\Bus\Command\Container;
use src\Shared\Domain\Bus\Command\CommandBus;
use src\Shared\Infrastructure\LaravelContainer;
use src\Shared\Infrastructure\RamseyUuidGenerator;
use src\frontoffice\Categories\Domain\CategoryRepository;
use src\Shared\Infrastructure\CviebrockEloquentSluggable;
use src\Shared\Infrastructure\Bus\Command\SimpleCommandBus;
use src\frontoffice\Categories\Infrastructure\Persistence\Eloquent\EloquentCategoryRepository;


class CategoryServiceProvider extends ServiceProvider
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
        CategoryRepository::class, 
        EloquentCategoryRepository::class
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
