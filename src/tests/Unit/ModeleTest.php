<?php

/**
 * ============================================================
 * SPRINT 1 — AB (Abibou Ndione)
 * Tests unitaires Pest — Modèles
 * Carte #4 — Tester : relations, factories, scopes, fillable/guarded
 * Checklist : pest --filter=ModeleTest · couverture > 80% · CI passe
 *
 * Lancer : php artisan test --filter=ModeleTest
 *       ou : ./vendor/bin/pest tests/Unit/ModeleTest.php
 * ============================================================
 */

use App\Models\Praticien;
use App\Models\User;
use App\Models\Visite;
use App\Models\Zone;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

// ══════════════════════════════════════════════════════════════
// TESTS — MODÈLE ZONE
// ══════════════════════════════════════════════════════════════

describe('Modèle Zone', function () {

    it('peut être créée avec les champs corrects', function () {
        $zone = Zone::factory()->create([
            'nom'            => 'Dakar Centre',
            'region'         => 'Dakar',
            'code_postal'    => 'DK-001',
            'ville_principale' => 'Dakar',
        ]);

        expect($zone)->toBeInstanceOf(Zone::class)
            ->and($zone->nom)->toBe('Dakar Centre')
            ->and($zone->region)->toBe('Dakar');
    });

    it('a plusieurs praticiens (hasMany)', function () {
        $zone = Zone::factory()->create();
        Praticien::factory()->count(3)->create(['zone_id' => $zone->id]);

        expect($zone->praticiens)->toHaveCount(3)
            ->and($zone->praticiens->first())->toBeInstanceOf(Praticien::class);
    });

    it('a plusieurs utilisateurs (hasMany)', function () {
        $zone = Zone::factory()->create();
        User::factory()->count(2)->create(['zone_id' => $zone->id, 'role' => 'delegate']);

        expect($zone->utilisateurs)->toHaveCount(2);
    });

    it('scope actives filtre correctement', function () {
        Zone::factory()->create(['is_active' => true]);
        Zone::factory()->create(['is_active' => false]);

        $actives = Zone::actives()->get();
        expect($actives->every(fn ($z) => $z->is_active === true))->toBeTrue();
    });

    it('scope parDelegue retourne la bonne zone', function () {
        $zone     = Zone::factory()->create();
        $delegue  = User::factory()->create(['zone_id' => $zone->id, 'role' => 'delegate']);

        $result = Zone::parDelegue($delegue->id)->first();
        expect($result?->id)->toBe($zone->id);
    });

    it('attribut nomComplet est correct', function () {
        $zone = Zone::factory()->create(['nom' => 'Dakar Centre', 'region' => 'Dakar']);
        expect($zone->nom_complet)->toBe('Dakar Centre (Dakar)');
    });

});

// ══════════════════════════════════════════════════════════════
// TESTS — MODÈLE PRATICIEN
// ══════════════════════════════════════════════════════════════

describe('Modèle Praticien', function () {

    it('peut être créé via factory', function () {
        $praticien = Praticien::factory()->create();

        expect($praticien)->toBeInstanceOf(Praticien::class)
            ->and($praticien->nom)->not->toBeEmpty()
            ->and($praticien->specialite)->not->toBeEmpty();
    });

    it('appartient à une zone (belongsTo)', function () {
        $zone      = Zone::factory()->create();
        $praticien = Praticien::factory()->create(['zone_id' => $zone->id]);

        expect($praticien->zone)->toBeInstanceOf(Zone::class)
            ->and($praticien->zone->id)->toBe($zone->id);
    });

    it('a plusieurs visites (hasMany)', function () {
        $praticien = Praticien::factory()->create();
        $delegue   = User::factory()->create(['role' => 'delegate']);
        Visite::factory()->count(3)->create([
            'praticien_id' => $praticien->id,
            'delegue_id'   => $delegue->id,
        ]);

        expect($praticien->visites)->toHaveCount(3);
    });

    it('scope parSpecialite filtre correctement', function () {
        Praticien::factory()->create(['specialite' => 'Cardiologie']);
        Praticien::factory()->create(['specialite' => 'Pédiatrie']);

        $cardios = Praticien::parSpecialite('Cardio')->get();
        expect($cardios)->each(fn ($p) => $p->specialite->toContain('Cardio'));
    });

    it('scope recherche fulltext fonctionne par nom', function () {
        $praticien = Praticien::factory()->create(['nom' => 'Ndiaye', 'prenom' => 'Fatou']);
        Praticien::factory()->create(['nom' => 'Diallo', 'prenom' => 'Ibrahima']);

        $result = Praticien::recherche('Ndiaye')->get();
        expect($result)->toHaveCount(1)
            ->and($result->first()->nom)->toBe('Ndiaye');
    });

    it('scope filtre gère les paramètres vides (Carte #5 KG)', function () {
        Praticien::factory()->count(5)->actif()->create();
        Praticien::factory()->count(2)->create(['is_active' => false]);

        // Sans filtres — doit retourner seulement les actifs
        $result = Praticien::filtre()->get();
        expect($result->count())->toBeGreaterThanOrEqual(5)
            ->and($result->every(fn ($p) => $p->is_active === true))->toBeTrue();
    });

    it('attribut nomComplet est correct', function () {
        $p = Praticien::factory()->create([
            'titre' => 'Dr.', 'prenom' => 'Awa', 'nom' => 'Ndiaye'
        ]);
        expect($p->nom_complet)->toBe('Dr. Awa Ndiaye');
    });

    it('fillable protège les champs non autorisés', function () {
        $praticien = Praticien::factory()->create();
        expect($praticien->getFillable())->toContain('nom')
            ->and($praticien->getFillable())->toContain('specialite')
            ->and($praticien->getFillable())->not->toContain('id')
            ->and($praticien->getFillable())->not->toContain('created_at');
    });

});

// ══════════════════════════════════════════════════════════════
// TESTS — MODÈLE VISITE
// ══════════════════════════════════════════════════════════════

describe('Modèle Visite', function () {

    it('peut être créée via factory avec état planifiee', function () {
        $visite = Visite::factory()->planifiee()->create();

        expect($visite)->toBeInstanceOf(Visite::class)
            ->and($visite->statut)->toBe('planifiee');
    });

    it('peut être créée via factory avec état realisee', function () {
        $visite = Visite::factory()->realisee()->create();

        expect($visite->statut)->toBe('realisee')
            ->and($visite->rapport_soumis_le)->not->toBeNull()
            ->and($visite->evaluation)->toBeGreaterThanOrEqual(3);
    });

    it('appartient à un délégué (belongsTo)', function () {
        $delegue = User::factory()->create(['role' => 'delegate']);
        $visite  = Visite::factory()->create(['delegue_id' => $delegue->id]);

        expect($visite->delegue)->toBeInstanceOf(User::class)
            ->and($visite->delegue->id)->toBe($delegue->id);
    });

    it('appartient à un praticien (belongsTo)', function () {
        $praticien = Praticien::factory()->create();
        $visite    = Visite::factory()->create(['praticien_id' => $praticien->id]);

        expect($visite->praticien)->toBeInstanceOf(Praticien::class)
            ->and($visite->praticien->id)->toBe($praticien->id);
    });

    it('scope parDelegue filtre correctement', function () {
        $delegue1 = User::factory()->create(['role' => 'delegate']);
        $delegue2 = User::factory()->create(['role' => 'delegate']);

        Visite::factory()->count(3)->create(['delegue_id' => $delegue1->id]);
        Visite::factory()->count(2)->create(['delegue_id' => $delegue2->id]);

        expect(Visite::parDelegue($delegue1->id)->count())->toBe(3);
        expect(Visite::parDelegue($delegue2->id)->count())->toBe(2);
    });

    it('scope duMois retourne les visites du mois courant', function () {
        $delegue = User::factory()->create(['role' => 'delegate']);

        // 2 visites ce mois
        Visite::factory()->duMoisEnCours()->count(2)->create(['delegue_id' => $delegue->id]);
        // 1 visite le mois dernier
        Visite::factory()->create([
            'delegue_id'  => $delegue->id,
            'date_visite' => now()->subMonth(),
        ]);

        $duMois = Visite::parDelegue($delegue->id)->duMois()->count();
        expect($duMois)->toBe(2);
    });

    it('scope aVenir retourne les visites futures non annulées', function () {
        $delegue = User::factory()->create(['role' => 'delegate']);

        Visite::factory()->create([
            'delegue_id'  => $delegue->id,
            'date_visite' => now()->addDays(2),
            'statut'      => 'planifiee',
        ]);
        Visite::factory()->create([
            'delegue_id'  => $delegue->id,
            'date_visite' => now()->addDays(3),
            'statut'      => 'confirmee',
        ]);
        Visite::factory()->annulee()->create([
            'delegue_id'  => $delegue->id,
            'date_visite' => now()->addDays(4),
        ]);

        $aVenir = Visite::parDelegue($delegue->id)->aVenir()->get();
        expect($aVenir)->toHaveCount(2)
            ->and($aVenir->every(fn ($v) => $v->statut !== 'annulee'))->toBeTrue();
    });

    it('accesseur statutLabel retourne la bonne valeur', function () {
        $visite = Visite::factory()->make(['statut' => 'confirmee']);
        expect($visite->statut_label)->toBe('Confirmée');
    });

    it('accesseur estEnRetard détecte les visites en retard', function () {
        $visite = Visite::factory()->create([
            'date_visite' => now()->subDay(),
            'statut'      => 'planifiee',
        ]);
        expect($visite->est_en_retard)->toBeTrue();
    });

    it('scope avecRelations charge les eager loads sans N+1', function () {
        $delegue   = User::factory()->create(['role' => 'delegate']);
        $praticien = Praticien::factory()->create();

        Visite::factory()->count(3)->create([
            'delegue_id'   => $delegue->id,
            'praticien_id' => $praticien->id,
        ]);

        // Doit charger les relations sans requêtes supplémentaires
        $visites = Visite::avecRelations()->parDelegue($delegue->id)->get();

        expect($visites)->toHaveCount(3);
        expect($visites->first()->relationLoaded('praticien'))->toBeTrue();
        expect($visites->first()->relationLoaded('delegue'))->toBeTrue();
    });

});