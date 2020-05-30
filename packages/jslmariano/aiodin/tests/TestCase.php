<?php

namespace Tests;

use Jslmariano\Aiodin\AiodinFacade;
use Jslmariano\Aiodin\AiodinServiceProvider;
use Orchestra\Testbench\TestCase as OrchestraTestCase;

class TestCase extends OrchestraTestCase
{
    /**
     * Load package service provider
     * @param  \Illuminate\Foundation\Application $app
     * @return Jslmariano\Aiodin\AiodinServiceProvider
     */
    protected function getPackageProviders($app)
    {
        return [AiodinServiceProvider::class];
    }

    /**
     * Load package alias
     * @param  \Illuminate\Foundation\Application $app
     * @return array
     */
    protected function getPackageAliases($app)
    {
        return [
            'Aiodin' => AiodinFacade::class,
        ];
    }
}
