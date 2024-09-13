<?php

use Illuminate\Support\Facades\Route;
use MRTSec\HealthCheck\HealthCheckController;

Route::get('/', HealthCheckController::class)->name('health-check');