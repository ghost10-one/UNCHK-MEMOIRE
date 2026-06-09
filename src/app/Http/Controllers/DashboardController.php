<?php

namespace App\Http\Controllers;

use App\Models\Visite;
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
            'visits_today' => Visite::where('delegue_id', $user->id)->whereDate('date_visite', $today)->count(),
            'visits_week' => Visite::where('delegue_id', $user->id)
                ->whereBetween('date_visite', [now()->startOfWeek(), now()->endOfWeek()])
                ->count(),
            'pending_reports' => Visite::where('delegue_id', $user->id)
                ->where('statut', 'realisee')
                ->whereNull('compte_rendu')
                ->count(),
            'completion_rate' => $this->getCompletionRate($user->id),
        ];

        // Upcoming visits for today
        $upcomingVisits = Visite::with(['praticien'])
            ->where('delegue_id', $user->id)
            ->whereDate('date_visite', $today)
            ->orderBy('date_visite')
            ->get();

        return view('dashboard', compact('stats', 'upcomingVisits'));
    }

    private function getCompletionRate($userId)
    {
        $total = Visite::where('delegue_id', $userId)
            ->whereMonth('date_visite', now()->month)
            ->count();
        
        if ($total === 0) return 0;

        $completed = Visite::where('delegue_id', $userId)
            ->whereMonth('date_visite', now()->month)
            ->where('statut', 'realisee')
            ->count();

        return round(($completed / $total) * 100);
    }
}
