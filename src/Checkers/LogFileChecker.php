<?php

namespace MRTSec\HealthCheck\Checkers;

class LogFileChecker extends BaseHealthChecker
{
    public function check(): array
    {
        $path = $this->config['log_path'] ?? storage_path('logs/laravel.log');

        if (!file_exists($path)) {
            return $this->createReport(
                is_writable(dirname($path)),
                'Log directory is ' . (is_writable(dirname($path)) ? 'writable' : 'not writable')
            );
        }

        return $this->createReport(
            is_writable($path),
            'Log file is ' . (is_writable($path) ? 'writable' : 'not writable')
        );
    }
}