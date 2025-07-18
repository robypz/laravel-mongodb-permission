<?php

namespace RobYpz\LaravelMongodbPermission\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;
use RobYpz\LaravelMongodbPermission\Http\Middleware\Role;
use RobYpz\LaravelMongodbPermission\Models\Permission;

class LaravelMongoDBPermissionServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $router = $this->app->make(Router::class);
        $router->aliasMiddleware('role', Role::class);
        $router->aliasMiddleware('permission', Permission::class);

        $this->publishes([
            __DIR__ . '/../../database/migrations' => database_path('migrations'),
        ], 'laravel-assets');
    }
}
