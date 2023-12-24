<?php

namespace Galtsevt\Modular\App\Modular;

use Galtsevt\Modular\App\Facades\Modules;

abstract class ModuleProvider extends \Illuminate\Support\ServiceProvider
{
    protected string $name;
    protected Module $module;

    abstract protected function init(): void;

    abstract protected function run(): void;

    abstract protected function getModule(): Module;

    abstract protected function getDir(): string;

    protected function registerResources(): void
    {
        $this->loadMigrationsFrom($this->getDir() . '/../../database/migrations');
        $this->loadViewsFrom($this->getDir() . '/../../resources/views', $this->name);
        $this->loadRoutesFrom($this->getDir() . '/../../routes/web.php');
        $this->publishes([
            $this->getDir() . '/../../resources/views' => resource_path('views/vendor/' . $this->name),
        ], 'module-resources');
    }

    public function boot(): void
    {
        $this->module = $this->getModule();
        Modules::register($this->module);
        $this->registerResources();
        $this->run();
    }

    protected function isDashboard(): bool
    {
        return str_contains(url()->current(), '/admin');
    }
}
