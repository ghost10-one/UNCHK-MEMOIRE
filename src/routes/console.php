<?php
use App\Jobs\SendScheduledReportJob;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;


Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');


// Planification d'un rapport hebdomadaire tous les lundis à 8h00
Schedule::job(new SendScheduledReportJob('Hebdomadaire'))->weeklyOn(1, '08:00');

// Planification d'un rapport mensuel le 1er du mois à 08h30
Schedule::job(new SendScheduledReportJob('Mensuel'))->monthlyOn(1, '08:30');
