<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * ╔══════════════════════════════════════════════════════════════╗
 * ║  SPRINT 2 · AB — Abibou Ndione · Carte Trello #1            ║
 * ║  Migration : visite_tournee (table pivot)                   ║
 * ║                                                              ║
 * ║  Tâche :                                                     ║
 * ║    Table pivot visite_tournee :                              ║
 * ║      tournee_id, visite_id                                   ║
 * ║                                                              ║
 * ║  Checklist :                                                 ║
 * ║    ✓ FK correctes                                           ║
 * ║    ✓ rollback propre                                        ║
 * ╚══════════════════════════════════════════════════════════════╝
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('visite_tournee', function (Blueprint $table) {
            $table->id();

            // ── FK pivot (Carte #1 AB) ─────────────────────────
            $table->foreignId('tournee_id')
                  ->constrained('tournees')
                  ->cascadeOnDelete();

            $table->foreignId('visite_id')
                  ->constrained('visites')
                  ->cascadeOnDelete();

            // ── Ordre dans la tournée ────────────────────────
            $table->unsignedSmallInteger('ordre')->default(0)
                  ->comment('Ordre de passage optimisé par Maps');

            // ── Distance depuis l'arrêt précédent ────────────
            $table->decimal('distance_depuis_precedent_km', 8, 2)->nullable();
            $table->unsignedSmallInteger('duree_trajet_min')->nullable();

            $table->timestamps();

            // Unicité : une visite ne peut appartenir qu'une fois à une tournée
            $table->unique(['tournee_id', 'visite_id']);

            // Index pour les jointures fréquentes
            $table->index(['tournee_id', 'ordre']);
            $table->index('visite_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('visite_tournee');
    }
};