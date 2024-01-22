<?php

namespace Galtsevt\LaravelModular\App\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeModuleCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:module {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new module';

    /**
     * Execute the console command.
     */
    public function handle(): bool
    {
        define("DS", DIRECTORY_SEPARATOR);
        $moduleName = strtolower($this->argument('name'));
        $modulesPath = base_path('modules');
        $modulePath = $modulesPath . DS . ucfirst($moduleName);

        if (!is_dir($modulesPath) && !File::makeDirectory($modulesPath, 0777)) {
            $this->components->error('Failed to create module directory');
            return false;
        }

        if (is_dir($modulePath)) {
            $this->components->error('Module already exists');
            return false;
        }

        if (File::makeDirectory($modulePath, 0777)) {
            if (File::makeDirectory($modulePath . DS . 'App', 0777)) {
                File::makeDirectory($modulePath . DS . 'App' . DS . 'Providers', 0777);
                File::makeDirectory($modulePath . DS . 'App' . DS . 'Models', 0777);
                File::makeDirectory($modulePath . DS . 'App' . DS . 'Controllers', 0777);
                File::makeDirectory($modulePath . DS . 'App' . DS . 'Requests', 0777);
                File::makeDirectory($modulePath . DS . 'App' . DS . 'Resources', 0777);
            }
            if (File::makeDirectory($modulePath . DS . 'database', 0777)) {
                File::makeDirectory($modulePath . DS . 'database' . DS . 'migrations', 0777);
            }
            File::copyDirectory(__DIR__ . '/../../example/routes', $modulePath . DS . 'routes');
            File::put($this->getModuleProviderPath($modulePath, $moduleName), $this->buildModuleProviderClass($moduleName));
            $this->components->info(sprintf('%s [%s] created successfully.', $moduleName, $modulePath));
            return true;
        }
        $this->components->error('Error creating module');
        return false;
    }

    protected function buildModuleProviderClass($moduleName): string
    {
        $stub = File::get(__DIR__ . '/../../resources/stubs/module.provider.stub');
        return str_replace(['{{ ucFirstName }}', '{{ name }}'], [ucfirst($moduleName), $moduleName], $stub);
    }

    protected function getModuleProviderPath($modulePath, $moduleName): string
    {
        return $modulePath . DS . 'App' . DS . 'Providers' . DS . ucfirst($moduleName) . 'ModuleProvider.php';
    }
}
