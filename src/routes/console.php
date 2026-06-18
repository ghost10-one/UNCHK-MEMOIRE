<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Schedule cleanup of audit logs daily at 2 AM
Schedule::command('audit-logs:cleanup')
    ->daily()
    ->at('02:00')
    ->onOneServer()
    ->withoutOverlapping();
