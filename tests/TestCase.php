<?php

use Carbon\Carbon;
use Laravel\Lumen\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    protected function now(): string
    {
        return Carbon::now()->format(DATE_ISO8601);
    }

    protected function tomorrow(): string
    {
        return Carbon::tomorrow()->format(DATE_ISO8601);
    }

    protected function nextMonth(): string
    {
        return Carbon::now()->addMonth()->format(DATE_ISO8601);
    }

    /**
     * Creates the application.
     *
     * @return \Laravel\Lumen\Application
     */
    public function createApplication()
    {
        return require __DIR__.'/../bootstrap/app.php';
    }
}
