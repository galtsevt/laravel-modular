<?php

namespace Galtsevt\LaravelModular\App\Providers;

use Galtsevt\LaravelModular\App\Commands\MakeModuleCommand;
use Galtsevt\LaravelModular\App\Contracts\ModuleManager;
use Galtsevt\LaravelModular\App\Modular\PermissionModuleManager;
use Galtsevt\LaravelModular\App\Modular\SimpleModuleManager;
use Illuminate\Support\ServiceProvider;

class ModularServiceProvider extends ServiceProvider
{

    public function register(): void
    {
        $this->app->bind(ModuleManager::class, function ($app) {
            return config('modular.withRoles') ? PermissionModuleManager::class : SimpleModuleManager::class;
        });
    }

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                MakeModuleCommand::class
            ]);
        }

        if (config('modular.withRoles')) {
            $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');
        }

        $this->publishes([
            __DIR__ . '/../../config/modular.php' => config_path('modular.php'),
        ], 'laravel-modular');

        $this->mergeConfigFrom(
            __DIR__ . '/../../config/modular.php', 'modular'
        );
    }
}
