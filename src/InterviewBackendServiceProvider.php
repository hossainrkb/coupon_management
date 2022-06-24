<?php

namespace Interview\Backend;

use Illuminate\Support\ServiceProvider;

class InterviewBackendServiceProvider extends ServiceProvider
{
    public function boot(): void
    {

        $this->loadRoutesFrom(__DIR__ . '/Routes/api.php');
        $this->loadMigrationsFrom(__DIR__ . '/database/Migrations');

        $this->publishes([
            __DIR__ . '/../publishable/assets/js/uncompiled-file' => resource_path('js/'),
        ], 'public');
        $this->publishes([
            __DIR__ . '/../publishable/assets/js/compiled-file' => public_path('js/'),
        ], 'public');
        $this->publishes([
            __DIR__ . '/../publishable/assets/css' => public_path('css/'),
        ], 'public');
        $this->publishes([
            __DIR__ . '/../publishable/view' => resource_path('/'),
        ], 'public');
        $this->publishes([
            __DIR__ . '/database/seeders' => database_path('seeders/'),
        ], 'public');
    }

    public function register(): void
    {
        // Register stuffs
    }
}
