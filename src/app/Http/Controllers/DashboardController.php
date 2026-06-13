<?php

namespace App\Http\Controllers;

use App\Models\User;
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

        if ($user->hasRole(User::ROLE_ADMIN)) {
            return redirect()->route('admin.dashboard');
        }

        if ($user->hasRole(User::ROLE_MANAGER)) {
            return redirect()->route('manager.dashboard');
        }

        if ($user->hasRole(User::ROLE_DELEGATE)) {
            return redirect()->route('delegate.dashboard');
        }

        if ($user->hasRole(User::ROLE_PRO_SANTÉ)) {
            return redirect()->route('praticien.dashboard');
        }

        return view('dashboard');
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
