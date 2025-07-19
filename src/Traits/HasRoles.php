<?php

namespace RobYpz\LaravelMongodbPermission\Traits;

use MongoDB\Laravel\Relations\BelongsToMany;
use RobYpz\LaravelMongodbPermission\Models\Permission;
use RobYpz\LaravelMongodbPermission\Models\Role;

trait HasRoles  {

    use HasPermissions;

    /**
     * The roles that belong to the user.
     *
     * @return \MongoDB\Laravel\Relations\BelongsToMany
     */
    public function roles() : BelongsToMany {
        return $this->belongsToMany(Role::class);
    }

    /**
     * Check if the user has a specific role.
     *
     * @param string $role
     * @return bool
     */
    public function hasRole($role) : bool {
        return $this->roles()->where('name', $role)->exists();
    }

    public function hasAnyRole(array $roles) : bool {
        return $this->roles()->whereIn('name', $roles)->exists();
    }

    /**
     * Assign a role to the user.
     *
     * @param string|array $role
     * @return void
     */

    public function assignRole($role) : void {
        if (is_string($role)) {
            $role = Role::where('name', $role)->firstOrFail();
        }elseif (is_array($role)) {
            $role = Role::whereIn('name', $role)->get();
        }
        $this->roles()->attach($role);
    }

    public function givePermissionTo($permission) : void {
        if (is_string($permission)) {
            $permission = Permission::where('name', $permission)->firstOrFail();
        } elseif (is_array($permission)) {
            $permission = Permission::whereIn('name', $permission)->get();
        }
        $this->permissions()->attach($permission);
    }

    public function removeRole($role) : void {
        if (is_string($role)) {
            $role = Role::where('name', $role)->firstOrFail();
        } elseif (is_array($role)) {
            $role = Role::whereIn('name', $role)->get();
        }
        $this->roles()->detach($role);
    }
}
