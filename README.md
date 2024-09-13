# Laravel Health Check

✅ Quickly set up a health check page for your Laravel application

  * Inspired by [Levelsio's Podcast with Lex Friedman](https://www.youtube.com/watch?v=oFtjKbXKqbg) and copied from [All Goods](https://github.com/rameerez/allgood)

| Health Check Passed | We Have Some issues |
|--|--|
| ![Screenshot - Passed](https://zupimages.net/up/24/37/shwh.png)  | ![Screenshot Failed](https://zupimages.net/up/24/37/s4u1.png) |

## Installation

You can install the package via composer:

```bash
composer require  mrtsec/laravel-health-check
```

## Usage

After installation, you can access the health check page at `/health`.

## Configuration

Publish the configuration file:

```bash
php  artisan  vendor:publish  --provider="MRTSec\HealthCheck\HealthCheckServiceProvider"  --tag="config"
```

This will create a `health-check.php` file in your `config` directory. Here's an explanation of the configuration options:

```php
return [
    // The route prefix for the health check page
    'route_prefix' => 'health',

    // Middleware to apply to the health check route
    'middleware' => ['web'],

    // Define your health checks here
    'checks' => [
        'We have an active database connection' => function () {
            return \DB::connection()->getPdo() ? true : false;
        },
        [...]
    ],
];
```

### Customizing Checks

You can add, remove, or modify the health checks in the `checks` array. Each check is a key-value pair where the key is the description of the check, and the value is a closure that returns `true` for a passed check and `false` for a failed check.

Example of adding a custom check:

```php
'checks' => [
    // ... existing checks ...
    'My Custom Service is running' => function () {
        return MyCustomService::isRunning();
    },
],
```
  
## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.