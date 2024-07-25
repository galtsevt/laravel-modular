<?php

namespace Galtsevt\LaravelModular\App\Modular;

use Galtsevt\LaravelModular\App\Contracts\ModuleManager;
use Galtsevt\LaravelModular\App\Exceptions\ModuleNotFoundException;

class SimpleModuleManager implements ModuleManager
{
    protected array $modules;
    protected ?string $current = null;

    public function __construct(protected array $config = [])
    {

    }

    public function register(Module $module): static
    {
        $module->setManager($this);
        $this->modules[$module->getKey()] = $module;
        return $this;
    }

    public function getAll(): array
    {
        return array_values($this->modules);
    }

    public function has(string $key): bool
    {
        return array_key_exists($key, $this->modules);
    }

    /**
     * @throws ModuleNotFoundException
     */
    public function get(string $key): ?Module
    {
        if (!$this->has($key)) {
            return throw new ModuleNotFoundException('Module not found');
        }

        return $this->modules[$key] ?? null;
    }

    /**
     * @throws ModuleNotFoundException
     */
    public function getCurrent(): ?Module
    {
        return $this->get($this->current);
    }

    /**
     * @throws ModuleNotFoundException
     */
    public function setCurrent(string $key): static
    {
        if (!$this->has($key)) {
            return throw new ModuleNotFoundException('Module not found');
        }

        $this->current = $key;
        return $this;
    }

    public function moduleIsActive(string $key): bool
    {
        return isset($this->config['modules'][$key]['active']) && $this->config[$key]['active'] == true;
    }

}
