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
        
        // Ensure user sees only their own visits if they are a delegate
        // Or if you have a specific role check, you can do it here. 
        // For now, assuming standard user sees their own.
        // $query->where('delegue_id', Auth::id()); 

        if ($request->filled('date')) {
            $query->whereDate('date_visite', $request->input('date'));
        }

        $visites = $query->orderBy('date_visite', 'desc')->paginate(10)->withQueryString();

        return view('visites.index', compact('visites'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $praticiens = Praticien::actifs()->get(); // Assuming 'actifs' scope exists
        return view('visites.create', compact('praticiens'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(VisiteRequest $request)
    {
        $validated = $request->validated();
        
        // Add current logged in user as the delegue
        $validated['delegue_id'] = Auth::id() ?? 1; // Fallback to 1 for testing if not auth

        Visite::create($validated);

        return redirect()->route('visites.index')
                         ->with('success', 'Rapport de visite enregistré avec succès.');
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
}
