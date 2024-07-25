<?php

namespace Galtsevt\LaravelModular\App\Modular;

use App\Models\User;
use Illuminate\Support\Facades\Gate;

class PermissionModuleManager extends SimpleModuleManager
{

    public function register(Module $module): static
    {
        if (method_exists($module, 'permissions')) {
            $this->registerPermissions($module->permissions());
        }
        return parent::register($module);
    }

    protected function registerPermissions($permissions): void
    {
        foreach ($permissions as $permission) {
            $this->registerPermission($permission);
        }
    }

    protected function registerPermission(Permission $permission): void
    {
        Gate::define($permission->getKey(), function (User $user) use ($permission) {
            return array_intersect((array)$permission->getKey(), (array)$user->permissions()) || $user->is_root;
        });
    }

}
