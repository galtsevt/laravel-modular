<?php

namespace Galtsevt\Modular\App\Modular;

class ModulesManager
{
    protected array $modules;

    public function register(Module $module): static
    {
        $this->modules[] = $module;
        return $this;
    }

    public function getAll(): array
    {
        return $this->modules;
    }

    public function get(string $key): ?Module
    {
        foreach ($this->modules as $module) {
            if ($module->getKey() === $key)
                return $module;
        }

        return null;
    }

    public function getCurrent(): ?Module
    {
        foreach ($this->modules as $module) {
            if ($module->getCurrent())
                return $module;
        }

        return null;
    }

    public function setCurrent(string $key): static
    {
        $this->get($key)?->setCurrent();
        return $this;
    }

}
