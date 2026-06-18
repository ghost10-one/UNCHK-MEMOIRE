<?php

namespace Database\Factories;

use App\Models\Tournee;
use App\Models\User;
use App\Models\Zone;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * ╔══════════════════════════════════════════════════════════════╗
 * ║  SPRINT 2 · AB — Abibou Ndione · Carte Trello #2            ║
 * ║  TourneeFactory — support pour les tests Pest               ║
 * ║  Utilisée par : TourneeTest.php                             ║
 * ╚══════════════════════════════════════════════════════════════╝
 */
class TourneeFactory extends Factory
{
    protected $model = Tournee::class;

    public function definition(): array
    {
        $debut  = $this->faker->dateTimeBetween('-1 month', '+1 month');
        $fin    = (clone $debut)->modify('+' . $this->faker->numberBetween(1, 5) . ' days');

        return [
            'delegue_id'           => User::factory()->delegate(),
            'zone_id'              => Zone::factory(),
            'titre'                => 'Tournée ' . $this->faker->city(),
            'date_debut'           => $debut->format('Y-m-d'),
            'date_fin'             => $fin->format('Y-m-d'),
            'heure_debut'          => '08:00',
            'heure_fin'            => '18:00',
            'statut'               => $this->faker->randomElement([
                'planifiee', 'en_cours', 'terminee',
            ]),
            'notes'                => $this->faker->optional()->sentence(),
            'nb_visites_prevues'   => $this->faker->numberBetween(2, 8),
            'nb_visites_realisees' => 0,
            'distance_totale_km'   => $this->faker->optional()->randomFloat(2, 5, 80),
            'duree_estimee_min'    => $this->faker->optional()->numberBetween(30, 240),
        ];
    }

    // ── États ─────────────────────────────────────────────────

    public function planifiee(): static
    {
        return $this->state([
            'statut'     => 'planifiee',
            'date_debut' => now()->addDays(2)->format('Y-m-d'),
            'date_fin'   => now()->addDays(4)->format('Y-m-d'),
        ]);
    }

    public function enCours(): static
    {
        return $this->state([
            'statut'     => 'en_cours',
            'date_debut' => today()->format('Y-m-d'),
            'date_fin'   => now()->addDays(1)->format('Y-m-d'),
        ]);
    }

    public function terminee(): static
    {
        return $this->state([
            'statut'     => 'terminee',
            'date_debut' => now()->subDays(5)->format('Y-m-d'),
            'date_fin'   => now()->subDays(3)->format('Y-m-d'),
        ]);
    }

    public function annulee(): static
    {
        return $this->state([
            'statut'           => 'annulee',
            'motif_annulation' => $this->faker->randomElement([
                'Délégué absent', 'Zone inaccessible', 'Intempéries',
            ]),
        ]);
    }

    /** Tournée du mois courant */
    public function duMoisEnCours(): static
    {
        return $this->state([
            'date_debut' => now()->startOfMonth()->addDays(rand(0, 10))->format('Y-m-d'),
            'date_fin'   => now()->startOfMonth()->addDays(rand(11, 20))->format('Y-m-d'),
        ]);
    }

    /** Tournée du mois dernier */
    public function moisDernier(): static
    {
        return $this->state([
            'date_debut' => now()->subMonth()->startOfMonth()->format('Y-m-d'),
            'date_fin'   => now()->subMonth()->startOfMonth()->addDays(3)->format('Y-m-d'),
        ]);
    }
}