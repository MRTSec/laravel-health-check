<?php

namespace MRTSec\HealthCheck\Checkers;

use Illuminate\Support\Facades\Artisan;

class MigrationStatusChecker extends BaseHealthChecker
{
    public function check(): array
    {
        try {
            $output = '';
            Artisan::call('migrate:status', [], $output);
            $pendingMigrations = substr_count($output, 'Pending');
            $isUpToDate = $pendingMigrations === 0;
            
            return $this->createReport(
                $isUpToDate,
                $isUpToDate ? 'All migrations are up to date' : "There are {$pendingMigrations} pending migrations"
            );
        } catch (\Exception $e) {
            return $this->createReport(false, 'Migration status check failed: ' . $e->getMessage());
        }
    }
}