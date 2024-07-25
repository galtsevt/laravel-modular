<?php

namespace Galtsevt\LaravelModular\App\Contracts;

use Galtsevt\LaravelModular\App\Modular\Module;

interface ModuleManager
{
    public function register(Module $module): static;

    public function getAll(): array;

    public function get(string $key): ?Module;

    public function has(string $key): bool;

    public function setCurrent(string $key): static;

    public function getCurrent(): ?Module;

    public function moduleIsActive(string $key): bool;
}
