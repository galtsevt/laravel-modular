<?php

namespace Galtsevt\LaravelModular\App\Modular;

class Permission
{
    public function __construct(protected string $key, protected string $name)
    {

    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
