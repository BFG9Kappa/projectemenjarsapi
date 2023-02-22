<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\Comanda;

class ComandesTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     * @group api
     **/
    public function llistat_carregue_correctament()
    {
        $comandes = Comanda::factory()->count(5)->create();
        $response = $this->get('/api/comandes');
        $response->assertStatus(200);
        foreach ($comandes as $comanda) {
            $response->assertJsonFragment([
                'nom' => $comanda->nom,
                'preu' => $comanda->preu,
                'estat' => $comanda->estat
            ]);
        }
    }

    /**
     * @test
     * @group api
     **/
    public function es_pot_crear_comanda()
    {
        $response = $this->post('/api/comandes', [
            'nom' => 'Comanda secreta',
            'preu' => 200,
            'estat' => 'Rebut',
        ]);
        $response->assertStatus(201);
        $this->assertDatabaseHas('comandes', [
            'nom' => 'Comanda secreta',
            'preu' => 200,
            'estat' => 'Rebut',
        ]);
    }

    /**
     * @test
     * @group api
     **/
    public function es_pot_mostrar_comanda()
    {
        $comanda = Comanda::factory()->create();
        $response = $this->get('/api/comandes/' . $comanda->id);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'success',
            'message',
            'data' => [
                'id',
                'nom',
                'preu',
                'estat',
                'created_at',
                'updated_at'
            ]
        ]);
        $response->assertJson([
            'success' => true,
            'message' => 'Comanda recuperada',
            'data' => [
                'id' => $comanda->id,
                'nom' => $comanda->nom,
                'preu' => $comanda->preu,
                'estat' => $comanda->estat,
                'created_at' => $comanda->created_at->toISOString(),
                'updated_at' => $comanda->updated_at->toISOString()
            ]
        ]);
    }

    /**
     * @test
     * @group api
     **/
    public function es_pot_actualitzar_comanda()
    {
        $comanda = Comanda::factory()->create();
        $response = $this->put("/api/comandes/{$comanda->id}", [
            'nom' => 'Comanda actualitzada',
            'preu' => 100,
            'estat' => 'En proces',
        ]);
        $response->assertStatus(200);
        $this->assertDatabaseHas('comandes', [
            'id' => $comanda->id,
            'nom' => 'Comanda actualitzada',
            'preu' => 100,
            'estat' => 'En proces',
        ]);
    }

    /**
     * @test
     * @group api
     **/
    public function es_pot_esborrar_ingredient()
    {
        $comanda = Comanda::factory()->create();
        $response = $this->delete("/api/comandes/{$comanda->id}");
        $response->assertStatus(200); // Tindrie que ser 204;
        $this->assertDatabaseMissing('comandes', ['id' => $comanda->id]);
    }

}
