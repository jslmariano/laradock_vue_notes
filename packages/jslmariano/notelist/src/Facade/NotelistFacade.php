<?php
namespace Jslmariano\Notelist\Facade;

use Illuminate\Support\Facades\Facade;

class NotelistFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'notelist';
    }
}
