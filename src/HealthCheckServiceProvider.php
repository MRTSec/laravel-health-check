<?php

namespace MRTSec\HealthCheck;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

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

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'health-check');

        $this->registerRoutes();
    }

    protected function registerRoutes()
    {
        Route::group($this->routeConfiguration(), function () {
            $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        });
    }

    protected function routeConfiguration()
    {
        return [
            'prefix' => config('health-check.route_prefix'),
            'middleware' => config('health-check.middleware'),
        ];
    }
}