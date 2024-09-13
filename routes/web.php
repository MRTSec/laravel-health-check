<?php

use Illuminate\Support\Facades\Route;
use MRTSec\HealthCheck\HealthCheckController;

Route::prefix(config('health-check.route_prefix', 'health'))->group(function () {
  Route::get('/', HealthCheckController::class)->name('health-check');
});