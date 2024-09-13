# Laravel Health Check

✅ Quickly set up a health check page for your Laravel application

  * Inspired by [Levelsio's Podcast with Lex Friedman](https://www.youtube.com/watch?v=oFtjKbXKqbg) and copied from [All Goods](https://github.com/rameerez/allgood)

| Health Check Passed | We Have Some issues |
|--|--|
| ![Screenshot - Passed](https://zupimages.net/up/24/37/shwh.png) | ![Screenshot Failed](https://zupimages.net/up/24/37/s4u1.png) |

## Installation

You can install the package via composer:

```bash
composer require mrtsec/laravel-health-check
```

## Usage

After installation, you can access the health check page at `/health`.

## Configuration

Publish the configuration file:

```bash
php artisan vendor:publish --provider="MRTSec\HealthCheck\HealthCheckServiceProvider" --tag="config"
```

This will create a `health-check.php` file in your `config` directory. Here's an explanation of the configuration options:

```php
<?php

use MRTSec\HealthCheck\Checkers\DatabaseConnectionChecker;
use MRTSec\HealthCheck\Checkers\DatabaseQueryChecker;
use MRTSec\HealthCheck\Checkers\MigrationStatusChecker;
use MRTSec\HealthCheck\Checkers\CacheChecker;
use MRTSec\HealthCheck\Checkers\DiskSpaceChecker;
use MRTSec\HealthCheck\Checkers\LogFileChecker;

return [
    // The route prefix for the health check page
    'route_prefix' => 'health',

    // Middleware to apply to the health check route
    'middleware' => ['web'],

    // Define your health checks here
    'checkers' => [
        'Database Connection' => [
            'class' => DatabaseConnectionChecker::class,
            'config' => [],
        ],
        [...]
    ],
];
```

### Customizing Checks

You can add, remove, or modify the health checks in the `checkers` array. Each check is defined by a key-value pair where:
- The key is the name of the check displayed on the health check page.
- The value is an array containing:
  - `class`: The fully qualified class name of the checker.
  - `config`: An array of configuration options specific to that checker.

To add a custom check:

1. Create a new checker class that implements the `MRTSec\HealthCheck\Contracts\HealthCheckerInterface`.
2. Add your checker to the `checkers` array in the configuration file.

Example of adding a custom checker:

```php
use App\HealthCheckers\MyCustomServiceChecker;

'checkers' => [
    // ... existing checkers ...
    'My Custom Service' => [
        'class' => MyCustomServiceChecker::class,
        'config' => [
            // Any configuration your checker might need
        ],
    ],
],
```

## Available Checkers

- **DatabaseConnectionChecker**: Verifies the database connection.
- **DatabaseQueryChecker**: Performs a simple database query.
- **MigrationStatusChecker**: Checks if all migrations are up to date.
- **CacheChecker**: Verifies that the cache system is working.
- **DiskSpaceChecker**: Checks available disk space.
- **LogFileChecker**: Ensures the log file is writable.

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.