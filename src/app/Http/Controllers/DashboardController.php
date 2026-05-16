<?php

namespace App\Http\Controllers;

use App\Models\Visit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $user = Auth::user();
        $today = now()->format('Y-m-d');

        // Stats for the dashboard
        $stats = [
            'visits_today' => Visit::where('user_id', $user->id)->whereDate('visit_date', $today)->count(),
            'visits_week' => Visit::where('user_id', $user->id)
                ->whereBetween('visit_date', [now()->startOfWeek(), now()->endOfWeek()])
                ->count(),
            'pending_reports' => Visit::where('user_id', $user->id)
                ->where('status', 'réalisée')
                ->whereNull('report')
                ->count(),
            'completion_rate' => $this->getCompletionRate($user->id),
        ];

        // Upcoming visits for today
        $upcomingVisits = Visit::with(['doctor.establishment'])
            ->where('user_id', $user->id)
            ->whereDate('visit_date', $today)
            ->orderBy('visit_time')
            ->get();

        return view('dashboard', compact('stats', 'upcomingVisits'));
    }

    private function getCompletionRate($userId)
    {
        $total = Visit::where('user_id', $userId)
            ->whereMonth('visit_date', now()->month)
            ->count();
        
        if ($total === 0) return 0;

        $completed = Visit::where('user_id', $userId)
            ->whereMonth('visit_date', now()->month)
            ->where('status', 'réalisée')
            ->count();

        return round(($completed / $total) * 100);
    }
}
