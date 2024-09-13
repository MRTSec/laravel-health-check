<?php

namespace MRTSec\HealthCheck;

use Illuminate\Support\ServiceProvider;

class HealthCheckServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/health-check.php', 'health-check');

        $this->app->singleton(HealthCheckManager::class, function ($app) {
            return new HealthCheckManager($app);
        });
    }

    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/health-check.php' => config_path('health-check.php'),
        ], 'health-check-config');

        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'health-check');
    }
}