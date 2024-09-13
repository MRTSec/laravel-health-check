<?php

namespace MRTSec\HealthCheck\Checkers;

use Illuminate\Support\Facades\DB;

class DatabaseQueryChecker extends BaseHealthChecker
{
    public function check(): array
    {
        try {
            $result = DB::select('SELECT 1');
            return $this->createReport(
                $result && $result[0]->{'1'} === 1,
                'Database query successful: SELECT 1 returned ' . ($result ? $result[0]->{'1'} : 'no result')
            );
        } catch (\Exception $e) {
            return $this->createReport(false, 'Database query failed: ' . $e->getMessage());
        }
    }
}