<?php
namespace Jslmariano\Aiodin\Facade;

use Illuminate\Support\Facades\Facade;

class AiodinFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'aiodin';
}
