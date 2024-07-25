<?php

namespace Galtsevt\LaravelModular\App\Services;

use Illuminate\Support\Facades\File;

class Stub
{
    public function render($stub, $data): string
    {
        $stub = $this->getStub($stub);
        $keys = array_map(fn($key) => '{{ ' . $key . ' }}', array_keys($data));
        $replace = array_values($data);
        return str_replace($keys, $replace, $stub);
    }

    protected function getStub($stub): string
    {
        return File::get(__DIR__ . '/../../resources/stubs/' . $stub);
    }
}
