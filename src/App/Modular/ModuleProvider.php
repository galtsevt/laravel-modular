<?php

namespace Galtsevt\LaravelModular\App\Modular;

use Galtsevt\LaravelModular\App\Facades\Modules;

abstract class ModuleProvider extends \Illuminate\Support\ServiceProvider
{
    protected string $name;
    protected string $moduleClass;
    protected Module $module;

    abstract protected function run(): void;

    protected function getDir(): string
    {
        $reflector = new \ReflectionClass($this);
        return dirname($reflector->getFileName());
    }

    protected function registerResources(): void
    {
        $this->loadMigrationsFrom($this->getDir() . '/../../database/migrations');
        $this->loadViewsFrom($this->getDir() . '/../../resources/views', $this->module->getKey());
        $this->loadRoutesFrom($this->getDir() . '/../../routes/web.php');
        $this->publishes([
            $this->getDir() . '/../../resources/views' => resource_path('views/vendor/' . $this->module->getKey()),
        ], 'module-resources');
    }

    public function boot(): void
    {
        $this->module = new $this->moduleClass;
        Modules::register($this->module);
        $this->registerResources();
        $this->run();
    }

    protected function isDashboard(): bool
    {
        return str_contains(url()->current(), '/admin');
    }
}
