# Laravel MongoDB Permission

A simple roles and permissions package for Laravel using MongoDB.

## Installation

You can install the package via composer:

```bash
composer require robypz/laravel-mongodb-permission
```

## Requirements

- PHP ^8.2
- Laravel ^12.0
- MongoDB Laravel ^5.2

## Configuration

1. Add the service provider to your `config/app.php`:

```php
'providers' => [
    // ...
    RobYpz\LaravelMongodbPermission\Providers\LaravelMongoDBPermissionServiceProvider::class,
];
```

2. Run the migrations:

```bash
php artisan migrate
```

## Usage

### Setup

Add the `HasRoles` trait to your User model:

```php
use RobYpz\LaravelMongodbPermission\Models\HasRoles;

class User extends Authenticatable
{
    use HasRoles;
    // ...
}
```

### Managing Roles

```php
// Assign a role to a user
$user->assignRole('admin');
// or
$user->assignRole(['admin', 'editor']);

// Check if a user has a role
$user->hasRole('admin');

// Check if a user has any of the given roles
$user->hasAnyRole(['admin', 'editor']);

// Remove a role from a user
$user->removeRole('admin');
```

### Managing Permissions

```php
// Give permission to a user
$user->givePermissionTo('edit-posts');
// or
$user->givePermissionTo(['edit-posts', 'delete-posts']);

// Check if a user has a permission
$user->hasPermission('edit-posts');

// Check if a user has any of the given permissions
$user->hasAnyPermission(['edit-posts', 'delete-posts']);

// Remove a permission from a user
$user->removePermission('edit-posts');
```

### Middleware

This package includes middleware for protecting routes:

```php
// Protect a route with role middleware
Route::get('/admin', function () {
    // ...
})->middleware('role:admin');

// Protect a route with permission middleware
Route::get('/posts/create', function () {
    // ...
})->middleware('permission:create-posts');
```

## License

The MIT License (MIT). Please see the [License File](LICENSE) for more information.

## Author

- Robert Yepez (robertyepez0208@hotmail.com)