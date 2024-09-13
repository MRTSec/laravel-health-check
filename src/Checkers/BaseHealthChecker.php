<?php

namespace MRTSec\HealthCheck\Checkers;

use MRTSec\HealthCheck\Contracts\HealthCheckerInterface;

abstract class BaseHealthChecker implements HealthCheckerInterface
{
    protected $config;

    public function __construct(array $config = [])
    {
        $this->config = $config;
    }

    abstract public function check(): array;

    protected function createReport(bool $status, string $message = ''): array
    {
        return [
            'status' => $status ? 'passed' : 'failed',
            'message' => $message,
        ];
    }
}