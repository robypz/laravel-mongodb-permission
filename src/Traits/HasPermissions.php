<?php

namespace RobYpz\LaravelMongodbPermission\Traits;

use MongoDB\Laravel\Relations\BelongsToMany;
use RobYpz\LaravelMongodbPermission\Models\Permission;
use RobYpz\LaravelMongodbPermission\Models\Role;

trait HasPermissions  {

    public function permission() : BelongsToMany {
        return $this->belongsToMany(Role::class);
    }

    public function hasPermission($permission) : bool {
        return $this->permission()->where('name', $permission)->exists();
    }

    public function hasAnyPermission(array $permissions) : bool {
        return $this->roles()->whereIn('name', $permissions)->exists();
    }

    public function removePermission($permission) : void {
        if (is_string($permission)) {
            $permission = Permission::where('name', $permission)->firstOrFail();
        } elseif (is_array($permission)) {
            $permission = Permission::whereIn('name', $permission)->get();
        }
        $this->permissions()->detach($permission);
    }
}