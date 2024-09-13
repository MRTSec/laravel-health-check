<?php

use MRTSec\HealthCheck\Checkers\DatabaseConnectionChecker;
use MRTSec\HealthCheck\Checkers\DatabaseQueryChecker;
use MRTSec\HealthCheck\Checkers\MigrationStatusChecker;
use MRTSec\HealthCheck\Checkers\CacheChecker;
use MRTSec\HealthCheck\Checkers\DiskSpaceChecker;
use MRTSec\HealthCheck\Checkers\LogFileChecker;

return [
    'route_prefix' => 'health',
    'middleware' => ['web'],
    'checkers' => [
        'Database Connection' => [
            'class' => DatabaseConnectionChecker::class,
            'config' => [],
        ],
        'Database Query' => [
            'class' => DatabaseQueryChecker::class,
            'config' => [],
        ],
        'Migration Status' => [
            'class' => MigrationStatusChecker::class,
            'config' => [],
        ],
        'Cache' => [
            'class' => CacheChecker::class,
            'config' => [],
        ],
        'Disk Space' => [
            'class' => DiskSpaceChecker::class,
            'config' => [
                'threshold' => 90, // percentage
            ],
        ],
        'Log File' => [
            'class' => LogFileChecker::class,
            'config' => [
                'log_path' => storage_path('logs/laravel.log'),
            ],
        ],
    ],
];