<?php

namespace Jslmariano\Notelist\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

/**
 * This class describes a note routes provider.
 */
class NoteRoutesProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'Jslmariano\Notelist\Http\Controllers';

    /**
     * Also boots parent ServiceProvider
     */
    public function boot()
    {
        parent::boot();
    }

    /**
     * invoked from parent ServiceProvider
     */
    public function map()
    {
        $this->mapApiRoutes();

    }

    /**
     * Register all routes from `/../Routes/api.php`
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
            ->middleware(['api','auth:api'])
            ->namespace($this->namespace)
            ->group(__DIR__ . '/../Routes/api.php');
    }
}
