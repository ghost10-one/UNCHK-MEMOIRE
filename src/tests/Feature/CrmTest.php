<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Praticien;
use App\Models\Zone;
use App\Models\Visite;

class CrmTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        // Setup base data
        $this->zone = Zone::factory()->create();
        $this->admin = User::factory()->create(['role' => 'admin', 'zone_id' => $this->zone->id]);
        $this->delegue = User::factory()->create(['role' => 'delegate', 'zone_id' => $this->zone->id]);
        $this->praticien = Praticien::factory()->create(['zone_id' => $this->zone->id]);
    }

    /**
     * CRM 1 : Validation form, Policy Gate
     */
    public function test_praticien_creation_validation_and_policy()
    {
        // Test Policy (Only Auth Users can view)
        $response = $this->get('/praticiens');
        $response->assertRedirect('/login');

        // Login as delegate
        $this->actingAs($this->delegue);

        // Validation error test
        $response = $this->post('/praticiens', []);
        $response->assertSessionHasErrors(['nom', 'prenom', 'specialite', 'zone_id']);

        // Success test
        $response = $this->post('/praticiens', [
            'nom' => 'Doe',
            'prenom' => 'John',
            'specialite' => 'Cardiologue',
            'zone_id' => $this->zone->id,
            'is_active' => true,
        ]);
        
        $response->assertRedirect('/praticiens');
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('praticiens', ['nom' => 'Doe']);
    }

    /**
     * CRM 2 : Test soumission rapport de visite
     */
    public function test_visite_report_submission_validation_and_flash()
    {
        $this->actingAs($this->delegue);

        // Validation test
        $response = $this->post('/visites', []);
        $response->assertSessionHasErrors(['praticien_id', 'date_visite', 'statut']);

        // Success test
        $response = $this->post('/visites', [
            'praticien_id' => $this->praticien->id,
            'date_visite' => now()->format('Y-m-d'),
            'statut' => 'realisee',
            'duree_min' => 30,
            'notes' => 'RAS',
        ]);

        $response->assertRedirect('/visites');
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('visites', [
            'praticien_id' => $this->praticien->id,
            'duree_min' => 30
        ]);
    }

    /**
     * CRM 3 & 4 : Test affichage historique, pagination, filtre date, and Eager Loading (jointure)
     */
    public function test_visite_historique_display_and_joins()
    {
        $this->actingAs($this->delegue);

        // Create 15 visits to test pagination (needs 10 per page)
        Visite::factory()->count(15)->create([
            'delegue_id' => $this->delegue->id,
            'praticien_id' => $this->praticien->id,
            'date_visite' => now(),
            'statut' => 'realisee'
        ]);

        $response = $this->get('/visites');
        
        $response->assertStatus(200);
        $response->assertViewHas('visites');
        
        // Assert Pagination (10 items on first page)
        $this->assertCount(10, $response->viewData('visites'));

        // Assert Join / Eager loading (CRM 4)
        $visite = collect($response->viewData('visites'))->first();
        $this->assertNotNull($visite->praticien);
        $this->assertNotNull($visite->delegue);
    }

    /**
     * CRM 5 : Test filtre vide/rempli pour praticiens
     */
    public function test_praticiens_filter_scopes()
    {
        $this->actingAs($this->delegue);

        Praticien::factory()->create(['nom' => 'Dupont', 'specialite' => 'Dermatologue', 'zone_id' => $this->zone->id]);
        Praticien::factory()->create(['nom' => 'Martin', 'specialite' => 'Généraliste', 'zone_id' => $this->zone->id]);

        // Filtre vide (returns all)
        $response = $this->get('/praticiens');
        $this->assertGreaterThanOrEqual(3, count($response->viewData('praticiens')));

        // Filtre rempli (Nom)
        $response = $this->get('/praticiens?recherche=Dupont');
        $praticiens = collect($response->viewData('praticiens')->items());
        $this->assertTrue($praticiens->contains('nom', 'Dupont'));
        $this->assertFalse($praticiens->contains('nom', 'Martin'));

        // Filtre rempli (Spécialité)
        $response = $this->get('/praticiens?specialite=Généraliste');
        $praticiens = collect($response->viewData('praticiens')->items());
        $this->assertTrue($praticiens->contains('specialite', 'Généraliste'));
    }
}
