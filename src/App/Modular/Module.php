<?php

namespace Galtsevt\Modular\App\Modular;

class Module
{
    protected bool $active = false;
    protected bool $current = false;

    public function __construct(
        protected string  $key,
        protected ?string $name = null
    )
    {
        $this->active = (bool)config('modules.' . $this->key . '.active');
    }

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
        return $this->active;
    }

    public function isCurrent(): bool
    {
        return $this->current;
    }

    public function setCurrent(): static
    {
        $this->current = true;
        return $this;
    }

}
