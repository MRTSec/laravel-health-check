<?php

namespace MRTSec\HealthCheck\Contracts;

interface HealthCheckerInterface
{
    /**
     * Perform the health check.
     *
     * @return array The result of the health check.
     */
    public function check(): array;
}