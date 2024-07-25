<?php

namespace Galtsevt\LaravelModular\App\Facades;

use Galtsevt\LaravelModular\App\Contracts\ModuleManager;
use Galtsevt\LaravelModular\App\Modular\Module;
use Illuminate\Support\Facades\Facade;

/**
 * @method static ModuleManager register(Module $module)
 * @method static Module get(string $key)
 * @method static array getAll()
 * @method static ModuleManager setCurrent(string $key)
 * @method static Module getCurrent()
 *
 * @see ModuleManager
 *
 **/
class Modules extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return ModuleManager::class;
    }
}
