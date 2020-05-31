<?php

namespace Jslmariano\Notelist\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Jslmariano\Notelist\Observers\NoteObserver;
use Jslmariano\Notelist\Models\Notes;

class NotesServiceProvider extends ServiceProvider
{

    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/../migrations');
        $this->publishes([
            __DIR__ . '/../resources/' => base_path('resources'),
        ]);

        Notes::observe(
            NoteObserver::class
        );
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
