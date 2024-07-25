<?php

namespace Galtsevt\LaravelModular\App\Modular;

use Galtsevt\LaravelModular\App\Contracts\ModuleManager;

class Module
{
    protected bool $active = false;
    protected bool $current = false;
    protected string $key = 'module';
    protected string $name = 'ModuleName';
    protected ModuleManager $manager;

    public function getName(): string
    {
        return $this->name;
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function isActive(): bool
    {
        return $this->manager->moduleIsActive($this->getKey());
    }

    public function isCurrent(): bool
    {
        return $this->manager->getCurrent()?->getKey() == $this->getKey();
    }

    public function setManager(ModuleManager $manager): static
    {
        $this->manager = $manager;
        return $this;
    }

}
