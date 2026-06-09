<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('praticiens', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prenom');
            $table->string('titre')->nullable();
            $table->string('specialite');
            $table->string('sous_specialite')->nullable();
            $table->string('telephone')->nullable();
            $table->string('email')->nullable();
            $table->string('email_secondaire')->nullable();
            $table->text('adresse')->nullable();
            $table->string('ville')->nullable();
            $table->string('code_postal')->nullable();
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->string('hopital')->nullable();
            $table->string('cabinet')->nullable();
            $table->string('type_etablissement')->nullable();
            $table->foreignId('zone_id')->nullable()->constrained('zones')->nullOnDelete();
            $table->json('jours_visite_preferes')->nullable();
            $table->time('heure_visite_preferee')->nullable();
            $table->text('notes')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('nb_visites_total')->default(0);
            $table->date('derniere_visite_le')->nullable();
            $table->foreignId('establishment_id')->nullable()->constrained('establishments')->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('visites', function (Blueprint $table) {
            $table->id();
            $table->foreignId('delegue_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('praticien_id')->constrained('praticiens')->cascadeOnDelete();
            $table->foreignId('zone_id')->nullable()->constrained('zones')->nullOnDelete();
            $table->foreignId('campagne_id')->nullable();
            $table->dateTime('date_visite');
            $table->dateTime('heure_debut')->nullable();
            $table->dateTime('heure_fin')->nullable();
            $table->string('statut')->default('planifiee');
            $table->string('motif_annulation')->nullable();
            $table->foreignId('annulee_par')->nullable()->constrained('users')->nullOnDelete();
            $table->text('notes')->nullable();
            $table->text('objectif')->nullable();
            $table->string('produit_presente')->nullable();
            $table->boolean('documentation_remise')->default(false);
            $table->boolean('echantillons_remis')->default(false);
            $table->integer('nb_echantillons')->default(0);
            $table->integer('duree_min')->nullable();
            $table->text('compte_rendu')->nullable();
            $table->integer('evaluation')->nullable();
            $table->dateTime('rapport_soumis_le')->nullable();
            $table->foreignId('rapport_valide_par')->nullable()->constrained('users')->nullOnDelete();
            $table->dateTime('rapport_valide_le')->nullable();
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->text('adresse_visite')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visites');
        Schema::dropIfExists('praticiens');
    }
};
