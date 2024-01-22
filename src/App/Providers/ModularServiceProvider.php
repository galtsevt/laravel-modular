<?php

namespace Galtsevt\LaravelModular\App\Providers;

use Galtsevt\LaravelModular\App\Commands\MakeModuleCommand;
use Galtsevt\LaravelModular\App\Modular\ModulesManager;
use Illuminate\Support\ServiceProvider;

class ModularServiceProvider extends ServiceProvider
{

    public function register(): void
    {
        $this->app->bind('app.modular.modules', fn() => new ModulesManager());
    }

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                MakeModuleCommand::class
            ]);
        }

        $this->publishes([
            __DIR__.'/../../config/modules.php' => config_path('modules.php'),
        ], 'laravel-modular');

        $this->mergeConfigFrom(
            __DIR__.'/../../config/modules.php', 'modules'
        );
    }
}
