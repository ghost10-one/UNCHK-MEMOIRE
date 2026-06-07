<?php

namespace Database\Factories;

use App\Models\Visit;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Visit>
 */
class VisitFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'doctor_id' => \App\Models\Doctor::factory(),
            'visit_date' => $this->faker->dateTimeBetween('-1 month', '+1 month')->format('Y-m-d'),
            'visit_time' => $this->faker->time('H:i'),
            'status' => $this->faker->randomElement(['planifiee', 'realisee', 'annulee']),
            'duration_minutes' => $this->faker->randomElement([15, 30, 45, 60]),
            'purpose' => $this->faker->sentence(),
        ];
    }
}


/**
 * ============================================================
 * SPRINT 1 — AB (Abibou Ndione)
 * VisiteFactory — Carte #1
 * Checklist : factory Visite · test relations · scope filtre
 * ============================================================
 */

namespace Database\Factories;

use App\Models\Praticien;
use App\Models\User;
use App\Models\Zone;
use App\Models\Visite;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * ============================================================
 * SPRINT 1 — AB (Abibou Ndione)
 * VisiteFactory — Carte #1
 * Checklist : factory Visite · test relations · scope filtre
 * ============================================================
 */
class VisiteFactory extends Factory
{
    protected $model = Visite::class;

    public function definition(): array
    {
        $statuts = ['planifiee', 'confirmee', 'realisee', 'annulee', 'manquee'];
        $statut  = $this->faker->randomElement($statuts);

        return [
            'delegue_id'         => User::factory(),
            'praticien_id'       => Praticien::factory(),
            'date_visite'        => $this->faker->dateTimeBetween('-1 month', '+1 month'),
            'statut'             => $statut,
            'objectif'           => $this->faker->sentence(8),
            'notes'              => $this->faker->optional()->paragraph(),
            'produit_presente'   => $this->faker->randomElement([
                'CardioPlus 5mg', 'PédiaFer Sirop', 'BronchoClear 10mg',
                'Amoxiclav 875mg', 'ORL-Clear 250mg', 'DiabexXL 500mg',
            ]),
            'documentation_remise' => $this->faker->boolean(70),
            'echantillons_remis'   => $this->faker->boolean(50),
            'nb_echantillons'      => $this->faker->numberBetween(0, 10),
            'duree_min'            => $this->faker->optional()->numberBetween(20, 90),
            'motif_annulation'     => $statut === 'annulee' ? $this->faker->sentence() : null,
            'latitude'             => $this->faker->latitude(14.0, 15.0),
            'longitude'            => $this->faker->longitude(-17.5, -16.0),
        ];
    }

    /** État : visite planifiée */
    public function planifiee(): static
    {
        return $this->state(['statut' => 'planifiee']);
    }

    /** État : visite confirmée */
    public function confirmee(): static
    {
        return $this->state(['statut' => 'confirmee']);
    }

    /** État : visite réalisée avec rapport */
    public function realisee(): static
    {
        return $this->state([
            'statut'             => 'realisee',
            'heure_debut'        => now()->subHours(2),
            'heure_fin'          => now()->subHour(),
            'duree_min'          => $this->faker->numberBetween(30, 60),
            'compte_rendu'       => $this->faker->paragraph(3),
            'evaluation'         => $this->faker->numberBetween(3, 5),
            'rapport_soumis_le'  => now()->subMinutes(30),
        ]);
    }

    /** État : visite annulée */
    public function annulee(): static
    {
        return $this->state([
            'statut'           => 'annulee',
            'motif_annulation' => $this->faker->randomElement([
                'Médecin indisponible',
                'Patient urgent',
                'Réunion imprévue',
                'Déplacement annulé',
            ]),
        ]);
    }

    /** État : visite du jour */
    public function duJour(): static
    {
        return $this->state([
            'date_visite' => today()->setHour(
                $this->faker->numberBetween(8, 17)
            ),
        ]);
    }

    /** État : visite de ce mois */
    public function duMoisEnCours(): static
    {
        return $this->state([
            'date_visite' => $this->faker->dateTimeBetween(
                now()->startOfMonth(),
                now()->endOfMonth()
            ),
        ]);
    }
}