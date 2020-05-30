<?php

namespace Jslmariano\Notelist\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class NotesServiceProvider extends ServiceProvider
{

    public function boot()
    {
        // $this->loadRoutesFrom(__DIR__ . '/../Routes/api.php');
        $this->loadMigrationsFrom(__DIR__.'/../migrations');
        $this->loadViewsFrom(__DIR__ . '/../views', 'notelist');
        $this->publishes([
            __DIR__ . '/../views' => base_path('resources/views/jslmariano/notelist'),
        ]);

    }

   /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Notelist::class, function () {
            return new Notelist();
        });
        $this->app->alias(Notelist::class, 'notelist');
    }

}
