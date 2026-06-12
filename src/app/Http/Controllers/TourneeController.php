<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTourneeRequest;
use App\Http\Requests\UpdateTourneeRequest;
use App\Models\Tournee;
use App\Models\Visite;
use App\Models\Zone;
use App\Services\GoogleMapsService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

/**
 * ╔══════════════════════════════════════════════════════════════╗
 * ║  SPRINT 2 · AB — Abibou Ndione · Carte Trello #3            ║
 * ║  TourneeController — CRUD complet                           ║
 * ║                                                              ║
 * ║  Routes resource :                                           ║
 * ║    index, show, create, store, edit, update, destroy        ║
 * ║    + cancel (annulation)                                     ║
 * ║                                                              ║
 * ║  Checklist :                                                 ║
 * ║    ✓ validation dates                                       ║
 * ║    ✓ chevauchement interdit (Tournee::chevauchementExiste)  ║
 * ║    ✓ policy Gate                                            ║
 * ╚══════════════════════════════════════════════════════════════╝
 */
class TourneeController extends Controller
{
    public function __construct(
        private readonly GoogleMapsService $mapsService,
    ) {}

    // ── index ─────────────────────────────────────────────────
    public function index(Request $request): View
    {
        Gate::authorize('viewAny', Tournee::class);

        $validated = $request->validate([
            'statut'     => 'nullable|in:planifiee,en_cours,terminee,annulee',
            'mois'       => 'nullable|integer|between:1,12',
            'annee'      => 'nullable|integer|min:2024',
            'delegue_id' => 'nullable|integer|exists:users,id',
        ]);

        /** @var \App\Models\User $user */
        $user = auth()->user();

        $query = Tournee::avecRelations()
            ->orderByDesc('date_debut');

        // Un délégué ne voit que ses propres tournées
        if ($user->isDelegate()) {
            $query->parDelegue($user->id);
        } elseif (!empty($validated['delegue_id'])) {
            $query->parDelegue($validated['delegue_id']);
        }

        if (!empty($validated['statut'])) {
            $query->where('statut', $validated['statut']);
        }

        if (!empty($validated['mois'])) {
            $query->duMois(
                $validated['mois'],
                $validated['annee'] ?? now()->year
            );
        }

        $tournees = $query->paginate(10)->withQueryString();
        $zones    = Zone::actives()->orderBy('nom')->get();

        return view('tournees.index', compact('tournees', 'zones', 'validated'));
    }

    // ── create ────────────────────────────────────────────────
    public function create(): View
    {
        Gate::authorize('create', Tournee::class);

        /** @var \App\Models\User $user */
        $user = auth()->user();

        // Visites planifiées/confirmées disponibles (sans tournée assignée)
        $visitesDisponibles = Visite::whereIn('statut', ['planifiee', 'confirmee'])
            ->when($user->isDelegate(), fn ($q) => $q->parDelegue($user->id))
            ->whereNotIn('id', function ($q) {
                $q->select('visite_id')->from('visite_tournee');
            })
            ->with(['praticien:id,nom,prenom,titre,specialite'])
            ->orderBy('date_visite')
            ->get();

        $zones = Zone::actives()->orderBy('nom')->get();

        return view('tournees.create', compact('visitesDisponibles', 'zones'));
    }

    // ── store ─────────────────────────────────────────────────
    public function store(StoreTourneeRequest $request): RedirectResponse
    {
        Gate::authorize('create', Tournee::class);

        $data = $request->validated();
        $data['delegue_id'] = auth()->id();

        // ── Vérification chevauchement (Carte #3 AB) ──────────
        if (Tournee::chevauchementExiste(
            $data['delegue_id'],
            $data['date_debut'],
            $data['date_fin'],
        )) {
            return back()
                ->withInput()
                ->withErrors([
                    'date_debut' => 'Vous avez déjà une tournée sur cette période. Veuillez choisir d\'autres dates.',
                ]);
        }

        $visiteIds = $data['visite_ids'] ?? [];
        unset($data['visite_ids']);

        $tournee = Tournee::create($data);

        // ── Association visites via pivot ─────────────────────
        if (!empty($visiteIds)) {
            $pivot = collect($visiteIds)->mapWithKeys(fn ($id, $idx) => [
                $id => ['ordre' => $idx + 1],
            ]);
            $tournee->visites()->sync($pivot);
            $tournee->recalculerCompteurs();
        }

        // ── Calcul itinéraire Google Maps (Carte #5 AB) ───────
        if (count($visiteIds) >= 2) {
            $this->mapsService->calculerItineraire($tournee);
        }

        return redirect()
            ->route('tournees.show', $tournee)
            ->with('success', '✅ Tournée créée avec succès.');
    }

    // ── show ──────────────────────────────────────────────────
    public function show(Tournee $tournee): View
    {
        Gate::authorize('view', $tournee);

        $tournee->load([
            'delegue:id,name,email',
            'zone:id,nom,region',
            'visites.praticien:id,nom,prenom,titre,specialite,hopital,adresse,latitude,longitude',
        ]);

        // Coordonnées pour Google Maps (Carte #5 AB)
        $marqueurs = $tournee->visites
            ->filter(fn ($v) => $v->praticien?->latitude && $v->praticien?->longitude)
            ->map(fn ($v) => [
                'id'        => $v->id,
                'lat'       => (float) $v->praticien->latitude,
                'lng'       => (float) $v->praticien->longitude,
                'titre'     => $v->praticien->nom_complet,
                'adresse'   => $v->praticien->adresse ?? '',
                'statut'    => $v->statut,
                'heure'     => $v->date_visite?->format('H:i'),
                'ordre'     => $v->pivot->ordre,
            ]);

        return view('tournees.show', compact('tournee', 'marqueurs'));
    }

    // ── edit ──────────────────────────────────────────────────
    public function edit(Tournee $tournee): View
    {
        Gate::authorize('update', $tournee);

        $user = auth()->user();

        $visitesDisponibles = Visite::whereIn('statut', ['planifiee', 'confirmee'])
            ->when($user->isDelegate(), fn ($q) => $q->parDelegue($user->id))
            ->with(['praticien:id,nom,prenom,titre,specialite'])
            ->orderBy('date_visite')
            ->get();

        $visitesSelectionnees = $tournee->visites->pluck('id')->toArray();
        $zones = Zone::actives()->orderBy('nom')->get();

        return view('tournees.edit', compact(
            'tournee', 'visitesDisponibles', 'visitesSelectionnees', 'zones'
        ));
    }

    // ── update ────────────────────────────────────────────────
    public function update(UpdateTourneeRequest $request, Tournee $tournee): RedirectResponse
    {
        Gate::authorize('update', $tournee);

        $data = $request->validated();

        // Vérification chevauchement (excluant la tournée courante)
        if (Tournee::chevauchementExiste(
            $tournee->delegue_id,
            $data['date_debut'],
            $data['date_fin'],
            $tournee->id,
        )) {
            return back()->withInput()->withErrors([
                'date_debut' => 'Cette période chevauche une autre tournée existante.',
            ]);
        }

        $visiteIds = $data['visite_ids'] ?? [];
        unset($data['visite_ids']);

        $tournee->update($data);

        $pivot = collect($visiteIds)->mapWithKeys(fn ($id, $idx) => [
            $id => ['ordre' => $idx + 1],
        ]);
        $tournee->visites()->sync($pivot);
        $tournee->recalculerCompteurs();

        return redirect()
            ->route('tournees.show', $tournee)
            ->with('success', 'Tournée mise à jour.');
    }

    // ── destroy ───────────────────────────────────────────────
    public function destroy(Tournee $tournee): RedirectResponse
    {
        Gate::authorize('delete', $tournee);

        $tournee->delete();

        return redirect()
            ->route('tournees.index')
            ->with('success', 'Tournée supprimée.');
    }

    // ── cancel (annulation) ───────────────────────────────────
    public function cancel(Request $request, Tournee $tournee): RedirectResponse
    {
        Gate::authorize('update', $tournee);

        $request->validate([
            'motif_annulation' => 'required|string|max:255',
        ]);

        $tournee->update([
            'statut'           => 'annulee',
            'motif_annulation' => $request->motif_annulation,
        ]);

        return redirect()
            ->route('tournees.index')
            ->with('success', 'Tournée annulée.');
    }

    // ── demarrer ──────────────────────────────────────────────
    public function demarrer(Tournee $tournee): RedirectResponse
    {
        Gate::authorize('update', $tournee);

        if ($tournee->statut !== 'planifiee') {
            return back()->withErrors(['statut' => 'Seules les tournées planifiées peuvent être démarrées.']);
        }

        $tournee->update(['statut' => 'en_cours']);

        return redirect()
            ->route('tournees.show', $tournee)
            ->with('success', '🚀 Tournée démarrée ! Bonne route.');
    }

    // ── terminer ──────────────────────────────────────────────
    public function terminer(Tournee $tournee): RedirectResponse
    {
        Gate::authorize('update', $tournee);

        $tournee->update(['statut' => 'terminee']);
        $tournee->recalculerCompteurs();

        return redirect()
            ->route('tournees.show', $tournee)
            ->with('success', '✅ Tournée marquée comme terminée.');
    }
}