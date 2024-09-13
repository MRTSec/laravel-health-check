<?php

namespace MRTSec\HealthCheck\Checkers;

class DiskSpaceChecker extends BaseHealthChecker
{
    public function check(): array
    {
        $threshold = $this->config['threshold'] ?? 90;
        $usage = 100 - (disk_free_space('/') / disk_total_space('/') * 100);
        $message = "Disk usage: {$usage}%, Threshold: {$threshold}%";
        return $this->createReport($usage < $threshold, $message);
    }
}