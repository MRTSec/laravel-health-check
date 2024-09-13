<?php

return [
    'route_prefix' => 'health',
    'middleware' => ['web'],
    'checks' => [
        'We have an active database connection' => function () {
            return \DB::connection()->getPdo() ? true : false;
        },
        'Database can perform a simple query' => function () {
            return \DB::table('users')->first() ? true : false;
        },
        'Database migrations are up to date' => function () {
            return \Illuminate\Support\Facades\Artisan::call('migrate:status') === 0;
        },
        'Cache is accessible and functioning' => function () {
            \Illuminate\Support\Facades\Cache::put('health_check_test', 'ok', 5);
            return \Illuminate\Support\Facades\Cache::get('health_check_test') === 'ok';
        },
        'Disk space usage is below 90%' => function () {
            $usage = 100 - (disk_free_space('/') / disk_total_space('/') * 100);
            return $usage < 90;
        },
    ],
];