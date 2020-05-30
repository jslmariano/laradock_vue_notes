<?php

namespace Tests;

use Jslmariano\Notelist\NotelistFacade;
use Jslmariano\Notelist\NotesServiceProvider;
use Orchestra\Testbench\TestCase as OrchestraTestCase;

class TestCase extends OrchestraTestCase
{
    /**
     * Load package service provider
     * @param  \Illuminate\Foundation\Application $app
     * @return Jslmariano\MyPackage\NotesServiceProvider
     */
    protected function getPackageProviders($app)
    {
        return [NotesServiceProvider::class];
    }

    /**
     * Load package alias
     * @param  \Illuminate\Foundation\Application $app
     * @return array
     */
    protected function getPackageAliases($app)
    {
        return [
            'Notelist' => NotelistFacade::class,
        ];
    }
}
