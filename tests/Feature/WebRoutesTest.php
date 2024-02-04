<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Sponsor;

class WebRoutesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function testAccueilRoute()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertViewIs('accueil');
    }

    /** @test */
    public function testDashboardRoute()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/dashboard');
        $response->assertStatus(200);
        $response->assertViewIs('dashboard');
    }

    /** @test */
    public function testSponsorsRoute()
    {
        $response = $this->get('/sponsors');
        $response->assertStatus(200);
        $response->assertViewIs('sponsors.index'); // Assurez-vous que la vue correspond à celle définie dans le contrôleur
    }

    /** @test */
    public function testSponsorDetailsRoute()
    {
        $sponsor = Sponsor::factory()->create();


        $response = $this->get('/sponsors/' . $sponsor->id);
        $response->assertStatus(200);
        $response->assertViewIs('sponsors.show'); // Assurez-vous que la vue correspond
    }

    /** @test */
    public function testTournoisRoute()
    {
        $response = $this->get('/tournois');
        $response->assertStatus(200);
        $response->assertViewIs('tournois');
    }

    // Tests pour les routes admin avec middleware admin
    /** @test */
    public function testAdminIndexRoute()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $response = $this->actingAs($admin)->get('/admin');
        $response->assertStatus(302);
    }

    // ... Autres tests pour les routes admin ...
}
