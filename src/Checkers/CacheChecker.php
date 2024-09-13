<?php

namespace MRTSec\HealthCheck\Checkers;

use Illuminate\Support\Facades\Cache;

class CacheChecker extends BaseHealthChecker
{
    public function check(): array
    {
        try {
            $key = 'health_check_test_' . time();
            $value = 'test_value';
            
            Cache::put($key, $value, 1);
            $retrievedValue = Cache::get($key);
            
            $isWorking = $retrievedValue === $value;
            
            return $this->createReport(
                $isWorking,
                $isWorking ? 'Cache is working correctly' : "Cache test failed: expected '{$value}', got '{$retrievedValue}'"
            );
        } catch (\Exception $e) {
            return $this->createReport(false, 'Cache check failed: ' . $e->getMessage());
        }
    }
}