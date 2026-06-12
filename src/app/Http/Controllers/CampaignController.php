<?php

namespace App\Http\Controllers;

use App\Http\Requests\CampaignRequest;
use App\Models\Campaign;
use App\Models\User;
use App\Models\Zone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class CampaignController extends Controller
{
    public function index(Request $request)
    {
        Gate::authorize('viewAny', Campaign::class);

        $query = Campaign::with(['delegue', 'zone']);

        if ($request->filled('zone_id')) {
            $query->where('zone_id', $request->input('zone_id'));
        }

        if ($request->filled('delegue_id')) {
            $query->where('delegue_id', $request->input('delegue_id'));
        }

        if ($request->filled('date_debut')) {
            $query->whereDate('date_debut', '>=', $request->input('date_debut'));
        }

        if ($request->filled('date_fin')) {
            $query->whereDate('date_fin', '<=', $request->input('date_fin'));
        }

        if ($request->filled('statut')) {
            $statut = $request->input('statut');
            if ($statut === 'en_cours') {
                $query->where('date_debut', '<=', now())->where('date_fin', '>=', now());
            } elseif ($statut === 'a_venir') {
                $query->where('date_debut', '>', now());
            } elseif ($statut === 'terminees') {
                $query->where('date_fin', '<', now());
            }
        }

        $campaigns = $query->orderBy('date_debut', 'desc')->paginate(10)->withQueryString();
        $zones = Zone::all();
        $delegues = User::role('delegate')->get();

        // Calculate KPIs
        $activesCount = Campaign::where('date_debut', '<=', now())->where('date_fin', '>=', now())->count();
        $totalObjectif = 350; // Fallback since no objectif column exists
        $tauxReussite = 78; // Placeholder for logic
        $joursRestants = 16; // Placeholder for logic

        return view('campaigns.index', compact('campaigns', 'zones', 'delegues', 'activesCount', 'totalObjectif', 'tauxReussite', 'joursRestants'));
    }

    public function create()
    {
        Gate::authorize('create', Campaign::class);

        $zones = Zone::all();
        $delegues = User::role('delegate')->get();

        return view('campaigns.create', compact('zones', 'delegues'));
    }

    public function store(CampaignRequest $request)
    {
        Gate::authorize('create', Campaign::class);

        $validated = $request->validated();

        if ($request->hasFile('digital_support')) {
            $validated['digital_support_path'] = $request->file('digital_support')->store('campaign_supports', 'public');
        }

        Campaign::create($validated);

        return redirect()->route('campaigns.index')->with('success', 'Campagne créée !');
    }

    public function show(Campaign $campaign)
    {
        Gate::authorize('view', $campaign);

        $campaign->load(['delegue', 'zone']);

        return view('campaigns.show', compact('campaign'));
    }

    public function edit(Campaign $campaign)
    {
        Gate::authorize('update', $campaign);

        $zones = Zone::all();
        $delegues = User::role('delegate')->get();

        return view('campaigns.edit', compact('campaign', 'zones', 'delegues'));
    }

    public function update(CampaignRequest $request, Campaign $campaign)
    {
        Gate::authorize('update', $campaign);

        $validated = $request->validated();

        if ($request->hasFile('digital_support')) {
            $validated['digital_support_path'] = $request->file('digital_support')->store('campaign_supports', 'public');
        }

        $campaign->update($validated);

        return redirect()->route('campaigns.index')->with('success', 'Campagne mise à jour !');
    }

    public function destroy(Campaign $campaign)
    {
        Gate::authorize('delete', $campaign);

        if ($campaign->digital_support_path && Storage::disk('public')->exists($campaign->digital_support_path)) {
            Storage::disk('public')->delete($campaign->digital_support_path);
        }

        $campaign->delete();

        return redirect()->route('campaigns.index')->with('success', 'Campagne supprimée avec succès.');
    }
}
