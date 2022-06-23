<?php

namespace Interview\Backend;

use Illuminate\Support\ServiceProvider;

class InterviewBackendServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__ . '/../Routes/api.php');

        $this->loadMigrationsFrom(__DIR__ . '/../database/Migrations');
    }

    public function register(): void
    {
        // Register stuffs
    }
}
