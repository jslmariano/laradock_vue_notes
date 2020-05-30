<?php

namespace Jslmariano\Aiodin\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AiodinServiceProvider extends ServiceProvider
{

    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/../migrations');
    }

   // /**
   //   * Register the application services.
   //   *
   //   * @return void
   //   */
   //  public function register()
   //  {
   //      $this->app->singleton(Aiodin::class, function () {
   //          return new Aiodin();
   //      });
   //      $this->app->alias(Aiodin::class, 'aiodin');
   //  }

}
