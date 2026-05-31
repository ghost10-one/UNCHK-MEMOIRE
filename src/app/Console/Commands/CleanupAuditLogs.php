<?php

namespace App\Console\Commands;

use App\Models\AuditLog;
use Illuminate\Console\Command;

class CleanupAuditLogs extends Command
{
    protected $signature = 'audit:cleanup {--days=90 : Number of days to retain}';
    protected $description = 'Delete audit logs older than the specified number of days';

    public function handle()
    {
        $days = $this->option('days');
        $cutoffDate = now()->subDays($days);

        $deletedCount = AuditLog::where('created_at', '<', $cutoffDate)->delete();

        $this->info("Deleted {$deletedCount} audit logs older than {$days} days.");
    }
}
