<?php

namespace MRTSec\HealthCheck\Checkers;

use Illuminate\Support\Facades\DB;

class DatabaseConnectionChecker extends BaseHealthChecker
{
    public function check(): array
    {
        try {
            $connection = DB::connection()->getPdo();
            return $this->createReport(true, 'Database connection successful');
        } catch (\Exception $e) {
            return $this->createReport(false, 'Database connection failed: ' . $e->getMessage());
        }
    }
}