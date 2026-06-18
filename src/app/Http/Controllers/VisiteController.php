<?php

namespace App\Http\Controllers;

use App\Models\Visite;
use App\Models\Praticien;
use App\Http\Requests\VisiteRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VisiteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Visite::avecRelations(); // Eager loading: with('praticien', 'delegue')
        
        // Count stats for tabs
        $stats = [
            'toutes' => (clone $query)->count(),
            'planifiee' => (clone $query)->whereIn('statut', ['planifiee', 'confirmee', 'en_cours'])->count(),
            'realisee' => (clone $query)->where('statut', 'realisee')->count(),
            'annulee' => (clone $query)->whereIn('statut', ['annulee', 'manquee'])->count(),
        ];

        // Filters
        if ($request->filled('date')) {
            $query->whereDate('date_visite', $request->input('date'));
        }

        if ($request->filled('statut')) {
            $statut = $request->input('statut');
            if ($statut === 'planifiee') {
                $query->whereIn('statut', ['planifiee', 'confirmee', 'en_cours']);
            } elseif ($statut === 'realisee') {
                $query->where('statut', 'realisee');
            } elseif ($statut === 'annulee') {
                $query->whereIn('statut', ['annulee', 'manquee']);
            }
        }

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->whereHas('praticien', function ($q) use ($search) {
                $q->where('nom', 'ILIKE', "%{$search}%")
                  ->orWhere('prenom', 'ILIKE', "%{$search}%")
                  ->orWhere('specialite', 'ILIKE', "%{$search}%");
            });
        }

        $visites = $query->orderBy('date_visite', 'desc')->paginate(10)->withQueryString();

        return view('visites.index', compact('visites', 'stats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $praticiens = Praticien::actifs()->get();
        $selectedPraticien = $praticiens->firstWhere('id', old('praticien_id'));

        return view('visites.create', compact('praticiens', 'selectedPraticien'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(VisiteRequest $request)
    {
        $validated = $request->validated();

        $validated['delegue_id'] = Auth::id() ?? 1;

        if (empty($validated['adresse_visite'])) {
            $praticien = Praticien::find($validated['praticien_id']);
            $validated['adresse_visite'] = $praticien?->adresse_complete ?? $praticien?->etablissement;
        }

        Visite::create($validated);

        return redirect()->route('visites.index')
                         ->with('success', 'Visite planifiée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Visite $visite)
    {
        $visite->load('praticien', 'delegue');
        return view('visites.show', compact('visite'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Visite $visite)
    {
        $praticiens = Praticien::actifs()->get();
        return view('visites.edit', compact('visite', 'praticiens'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(VisiteRequest $request, Visite $visite)
    {
        $visite->update($request->validated());

        return redirect()->route('visites.index')
                         ->with('success', 'Visite mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Visite $visite)
    {
        $visite->delete();

        return redirect()->route('visites.index')
                         ->with('success', 'Visite supprimée avec succès.');
    }

    public function export() 
    {
        return Excel::download(new VisitesExport, 'visites-' . now()->format('Y-m-d') . '.xlsx');
    }
}
