<?php

namespace Database\Factories;

use App\Models\Praticien;
use App\Models\Zone;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * ============================================================
 * SPRINT 1 — AB (Abibou Ndione)
 * PraticienFactory — Carte #2
 * Checklist : factory Praticien · test hasMany · recherche fulltext
 * ============================================================
 */
class PraticienFactory extends Factory
{
    protected $model = Praticien::class;

    private array $specialites = [
        'Cardiologie', 'Pédiatrie', 'Médecine Générale', 'Pneumologie',
        'ORL', 'Neurologie', 'Gynécologie', 'Chirurgie', 'Ophtalmologie',
        'Dermatologie', 'Psychiatrie', 'Rhumatologie', 'Endocrinologie',
    ];

    private array $hopitaux = [
        'Hôpital Fann', 'Clinique International', 'Polyclinique de Dakar',
        'Centre de Santé Pikine', 'Hôpital Principal', 'Clinique Pasteur',
        'Hôpital de Thiès', 'Centre Médical de Kaolack',
    ];

    public function definition(): array
    {
        $prenoms_africains = [
            'Amadou', 'Fatou', 'Ibrahima', 'Mariama', 'Ousmane',
            'Aminata', 'Mamadou', 'Aissatou', 'Moussa', 'Fatoumata',
        ];

        $noms_africains = [
            'Diallo', 'Ndiaye', 'Sow', 'Fall', 'Ba',
            'Traoré', 'Cissé', 'Diop', 'Kane', 'Sarr',
        ];

        return [
            'nom'                  => $this->faker->randomElement($noms_africains),
            'prenom'               => $this->faker->randomElement($prenoms_africains),
            'titre'                => 'Dr.',
            'specialite'           => $this->faker->randomElement($this->specialites),
            'telephone'            => '+221 ' . $this->faker->numerify('## ### ## ##'),
            'email'                => $this->faker->unique()->safeEmail(),
            'adresse'              => $this->faker->streetAddress(),
            'ville'                => $this->faker->randomElement(['Dakar', 'Thiès', 'Saint-Louis', 'Kaolack', 'Ziguinchor']),
            'hopital'              => $this->faker->optional(0.7)->randomElement($this->hopitaux),
            'type_etablissement'   => $this->faker->randomElement([
                'hopital_public', 'clinique_privee', 'cabinet', 'pharmacie'
            ]),
            'zone_id'              => Zone::inRandomOrder()->first()?->id,
            'is_active'            => $this->faker->boolean(90),
            'latitude'             => $this->faker->latitude(14.0, 15.0),
            'longitude'            => $this->faker->longitude(-17.5, -16.0),
            'jours_visite_preferes' => $this->faker->randomElements(
                ['lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi'],
                $this->faker->numberBetween(2, 4)
            ),
            'heure_visite_preferee' => $this->faker->randomElement([
                '09:00', '10:00', '11:00', '14:00', '15:00', '16:00'
            ]),
        ];
    }

    /** Praticien cardiologue */
    public function cardiologue(): static
    {
        return $this->state(['specialite' => 'Cardiologie']);
    }

    /** Praticien à l'hôpital public */
    public function hopitalPublic(): static
    {
        return $this->state([
            'hopital'            => 'Hôpital Fann',
            'type_etablissement' => 'hopital_public',
        ]);
    }

    /** Praticien actif */
    public function actif(): static
    {
        return $this->state(['is_active' => true]);
    }
}