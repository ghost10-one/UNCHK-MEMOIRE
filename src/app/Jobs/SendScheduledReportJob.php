<?php

namespace App\Jobs;

use App\Mail\ScheduledReportMail;
use App\Models\User;
use App\Exports\VisitesExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendScheduledReportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $period;

    /**
     * Create a new job instance.
     */
    public function __construct($period = 'Hebdomadaire')
    {
        $this->period = $period;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $fileName = 'exports/rapport_automatique_' . uniqid() . '.xlsx';
        
        Excel::store(new VisitesExport, $fileName, 'local');
        
        $absolutePath = storage_path('app/' . $fileName);

        $recipients = User::where('role', 'admin')->pluck('email');

        if ($recipients->isNotEmpty()) {
            Mail::to($recipients)->send(new ScheduledReportMail($absolutePath, $this->period));
        }

        if (file_exists($absolutePath)) {
            unlink($absolutePath);
        }
    }
}