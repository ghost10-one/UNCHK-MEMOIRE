<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * ╔══════════════════════════════════════════════════════════════╗
 * ║  SPRINT 2 · AB — Abibou Ndione · Carte Trello #1            ║
 * ║  Migration : tournees                                        ║
 * ║                                                              ║
 * ║  Tâche :                                                     ║
 * ║    Table tournees :                                          ║
 * ║      delegue_id, date_debut, date_fin, statut               ║
 * ║                                                              ║
 * ║  Checklist :                                                 ║
 * ║    ✓ FK correctes                                           ║
 * ║    ✓ rollback propre                                        ║
 * ║    ✓ index date_debut                                       ║
 * ╚══════════════════════════════════════════════════════════════╝
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tournees', function (Blueprint $table) {
            $table->id();

            // ── FK délégué (Carte #1 AB) ──────────────────────
            $table->foreignId('delegue_id')
                  ->constrained('users')
                  ->cascadeOnDelete();

            // ── Dates (Carte #1 AB) ───────────────────────────
            $table->date('date_debut');
            $table->date('date_fin');
            $table->time('heure_debut')->default('08:00');
            $table->time('heure_fin')->default('18:00');

            // ── Statut ────────────────────────────────────────
            $table->enum('statut', [
                'planifiee',   // créée, pas encore démarrée
                'en_cours',    // démarrée aujourd'hui
                'terminee',    // toutes les visites réalisées
                'annulee',     // annulée par le délégué ou manager
            ])->default('planifiee');

            $table->string('titre', 150)->nullable();
            $table->text('notes')->nullable();
            $table->string('motif_annulation', 255)->nullable();

            // ── Statistiques calculées (dénormalisation perf) ─
            $table->unsignedSmallInteger('nb_visites_prevues')->default(0);
            $table->unsignedSmallInteger('nb_visites_realisees')->default(0);
            $table->decimal('distance_totale_km', 8, 2)->nullable()
                  ->comment('Distance calculée par Google Maps');
            $table->unsignedSmallInteger('duree_estimee_min')->nullable()
                  ->comment('Durée estimée par Google Maps');

            // ── Zone principale ───────────────────────────────
            $table->foreignId('zone_id')
                  ->nullable()
                  ->constrained('zones')
                  ->nullOnDelete();

            $table->softDeletes();
            $table->timestamps();

            // ── Index (Carte #1 AB — index date_debut) ────────
            $table->index('date_debut');
            $table->index('date_fin');
            $table->index(['delegue_id', 'date_debut']);
            $table->index('statut');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tournees');
    }
};