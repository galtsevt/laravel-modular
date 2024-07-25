<?php

namespace Galtsevt\LaravelModular\App\Traits;

use Galtsevt\LaravelModular\App\Models\Role;

trait HasRole
{
    public function roleRelation(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }

    public function permissions()
    {
        return $this->roleRelation?->permissions;
    }
}
