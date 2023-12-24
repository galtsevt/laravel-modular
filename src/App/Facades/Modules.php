<?php

namespace Galtsevt\LaravelModular\App\Facades;

use Galtsevt\Modular\App\Modular\Module;
use Galtsevt\Modular\App\Modular\ModulesManager;
use Illuminate\Support\Facades\Facade;

/**
 * @method static ModulesManager register(Module $module)
 * @method static Module get(string $key)
 * @method static array getAll()
 * @method static ModulesManager setCurrent(string $key)
 * @method static Module getCurrent()
 *
 * @see ModulesManager
 *
 **/

class Modules extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'app.modular.modules';
    }
}
