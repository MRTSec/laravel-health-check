<?php

namespace MRTSec\HealthCheck;

class HealthCheckManager
{
    protected $app;

    public function __construct($app)
    {
        $this->app = $app;
    }

    public function runChecks()
    {
        $checks = config('health-check.checks', []);
        $results = [];

        foreach ($checks as $name => $check) {
            try {
                $start = microtime(true);
                $result = $check();
                $end = microtime(true);
                $time = round(($end - $start) * 1000, 1); // Time in milliseconds

                $results[$name] = [
                    'status' => $result ? 'passed' : 'failed',
                    'time' => $time . 'ms'
                ];
            } catch (\Exception $e) {
                $results[$name] = [
                    'status' => 'failed',
                    'time' => '0.0ms'
                ];
            }
        }

        return $results;
    }
}