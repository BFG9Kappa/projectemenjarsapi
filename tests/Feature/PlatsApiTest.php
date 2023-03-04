<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

use App\Models\Plat;

class PlatsApiTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @group api
     **/
    public function llistat_carregue_correctament()
    {
        $plats = Plat::factory()->count(5)->create();
        $response = $this->get('/api/plats');
        $response->assertOk();
        foreach ($plats as $plat) {
            $response->assertJsonFragment([
                'nom' => $plat->nom,
                'preu' => $plat->preu
            ]);
        }
    }

    /**
     * @test
     * @group api
     **/
    public function es_pot_crear_plat()
    {
        $response = $this->post('/api/plats', [
            'nom' => 'Plat secret',
            'preu' => 200,
        ]);
        $response->assertStatus(201);
        $this->assertDatabaseHas('plats', [
            'nom' => 'Plat secret',
            'preu' => 200,
        ]);
    }

    /**
     * @test
     * @group api
     **/
    public function es_pot_mostrar_plat()
    {
        $plat = Plat::factory()->create();
        $response = $this->get('/api/plats/' . $plat->id);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'success',
            'message',
            'data' => [
                'id',
                'nom',
                'preu',
                'created_at',
                'updated_at'
            ]
        ]);
        $response->assertJson([
            'success' => true,
            'message' => 'Plat recuperat',
            'data' => [
                'id' => $plat->id,
                'nom' => $plat->nom,
                'preu' => $plat->preu,
                'created_at' => $plat->created_at->toISOString(),
                'updated_at' => $plat->updated_at->toISOString()
            ]
        ]);
    }

    /**
     * @test
     * @group api
     **/
    public function es_pot_actualitzar_plat()
    {
        $plat = Plat::factory()->create();
        $response = $this->put("/api/plats/{$plat->id}", [
            'nom' => 'Plat actualitzat',
            'preu' => 100,
        ]);
        $response->assertStatus(200);
        $this->assertDatabaseHas('plats', [
            'id' => $plat->id,
            'nom' => 'Plat actualitzat',
            'preu' => 100,
        ]);
    }

    /**
     * @test
     * @group api
     **/
    public function es_pot_esborrar_plat()
    {
        $plat = Plat::factory()->create();
        $response = $this->delete("/api/plats/{$plat->id}");
        $response->assertStatus(200); // Tindrie que ser 204;
        $this->assertDatabaseMissing('plats', ['id' => $plat->id]);
    }

}
