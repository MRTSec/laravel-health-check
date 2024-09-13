<?php

namespace MRTSec\HealthCheck;

use MRTSec\HealthCheck\Contracts\HealthCheckerInterface;

class HealthCheckManager
{
    protected $app;
    protected $config;

    public function __construct($app)
    {
        $this->app = $app;
        $this->config = $app['config']['health-check'];
    }

    public function runChecks()
    {
        $results = [];

        foreach ($this->config['checkers'] as $name => $checker) {
            $checkerClass = $checker['class'];
            $checkerConfig = $checker['config'] ?? [];

            if (!class_exists($checkerClass)) {
                $results[$name] = $this->createErrorResult("Checker class not found: $checkerClass");
                continue;
            }

            $checkerInstance = new $checkerClass($checkerConfig);

            if (!$checkerInstance instanceof HealthCheckerInterface) {
                $results[$name] = $this->createErrorResult("Invalid checker class: $checkerClass");
                continue;
            }

            $results[$name] = $checkerInstance->check();
        }

        return $results;
    }

    protected function createErrorResult(string $message): array
    {
        return [
            'status' => 'error',
            'message' => $message,
        ];
    }
}