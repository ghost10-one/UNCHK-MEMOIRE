<?php

namespace App\Http\Controllers;

use App\Models\Praticien;
use App\Models\Zone;
use App\Http\Requests\PraticienRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PraticienController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        Gate::authorize('viewAny', Praticien::class);

        $praticiens = Praticien::filtre(
            $request->input('recherche'),
            $request->input('specialite'),
            $request->input('zone_id'),
            false // Not filtering only active to show all in CRUD list
        )
        ->with('zone')
        ->paginate(10)
        ->withQueryString();

        $zones = Zone::all();
        $specialites = Praticien::select('specialite')->distinct()->pluck('specialite')->filter();

        return view('praticiens.index', compact('praticiens', 'zones', 'specialites'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('create', Praticien::class);
        $zones = Zone::all();
        return view('praticiens.create', compact('zones'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PraticienRequest $request)
    {
        Gate::authorize('create', Praticien::class);

        Praticien::create($request->validated());

        return redirect()->route('praticiens.index')
                         ->with('success', 'Praticien ajouté avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Praticien $praticien)
    {
        Gate::authorize('view', $praticien);
        $praticien->load('zone', 'visites.delegue');

        return view('praticiens.show', compact('praticien'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Praticien $praticien)
    {
        Gate::authorize('update', $praticien);
        $zones = Zone::all();
        return view('praticiens.edit', compact('praticien', 'zones'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PraticienRequest $request, Praticien $praticien)
    {
        Gate::authorize('update', $praticien);

        $praticien->update($request->validated());

        return redirect()->route('praticiens.index')
                         ->with('success', 'Praticien mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Praticien $praticien)
    {
        Gate::authorize('delete', $praticien);

        $praticien->delete();

        return redirect()->route('praticiens.index')
                         ->with('success', 'Praticien supprimé avec succès.');
    }
}
