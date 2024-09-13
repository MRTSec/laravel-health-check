<?php

namespace MRTSec\HealthCheck;

use Illuminate\Routing\Controller;

class HealthCheckController extends Controller
{
    public function __invoke(HealthCheckManager $healthCheck)
    {
        $results = $healthCheck->runChecks();
        $status = collect($results)->every(fn($check) => $check['status'] === 'passed') ? 200 : 503;

        return response()->view('health-check::health-check', compact('results'), $status);
    }
}