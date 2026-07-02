<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;
use App\Models\User;
class AnalyticsController extends Controller
{
    public function index(Request $request)
    {
        $zone = $request->query('zone_id');

        $cacheKey = 'analytics_campaigns_zone_' . ($zone ?: 'all');
        $rows = Cache::remember($cacheKey, 300, function () use ($zone) {
            $campaigns = DB::table('campaigns')->when($zone, fn($q) => $q->where('zone_id', $zone))->orderByDesc('date_debut')->get();
            $out = [];
            foreach ($campaigns as $c) {
                $start = Carbon::parse($c->date_debut)->startOfDay();
                $end = Carbon::parse($c->date_fin)->endOfDay();
                $periodDays = $start->diffInDays($end) + 1;

                // visits in zone during campaign period
                $duringQ = DB::table('visites')->whereBetween('date_visite', [$start, $end])->where('zone_id', $c->zone_id);
                $during = $duringQ->count();

                // previous period same length preceding the campaign
                $prevEnd = $start->copy()->subDay();
                $prevStart = $prevEnd->copy()->subDays($periodDays - 1)->startOfDay();
                $before = DB::table('visites')->whereBetween('date_visite', [$prevStart, $prevEnd])->where('zone_id', $c->zone_id)->count();

                $delta = $during - $before;
                $percent = $before === 0 ? null : round(($delta / $before) * 100, 2);

                $out[] = (object)[
                    'id' => $c->id,
                    'titre' => $c->titre,
                    'zone_id' => $c->zone_id,
                    'date_debut' => $c->date_debut,
                    'date_fin' => $c->date_fin,
                    'visites_during' => $during,
                    'visites_before' => $before,
                    'delta' => $delta,
                    'percent_change' => $percent,
                ];
            }
            return collect($out);
        });

  $zones = Cache::remember('zones_list', 300, fn() => DB::table('zones')->select('id','name')->orderBy('name')->get());

$delegues = User::role('delegate')
->withCount('visites')
->orderByDesc('visites_count')
->get();

return view('admin.analytics', compact(
'rows',
'zones',
'zone',
'delegues'
));
}
}       