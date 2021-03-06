<?php

namespace Jslmariano\Notelist\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Debug\ExceptionHandler;

use Jslmariano\Notelist\Observers\NoteObserver;
use Jslmariano\Notelist\Models\Notes;
use Jslmariano\Notelist\Exceptions\RestApiHandler;


/**
 * This class describes a notes service provider.
 */
class NotesServiceProvider extends ServiceProvider
{

   /**
     * Hanldes package publish construct.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/../migrations');
        $this->publishes([
            __DIR__ . '/../resources/' => base_path('resources'),
        ]);

        $this->app->make('Illuminate\Database\Eloquent\Factory')
                    ->load(__DIR__ . '/../factories');

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
