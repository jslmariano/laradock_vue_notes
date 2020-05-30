<?php

namespace Jslmariano\Notelist\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

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

    public function boot()
    {
        parent::boot();
    }


    public function map()
    {
        $this->mapApiRoutes();

    }

    protected function mapApiRoutes()
    {
        Route::prefix('api')
            ->middleware(['api','auth:api'])
            ->namespace($this->namespace)
            ->group(__DIR__ . '/../Routes/api.php');
    }
}
