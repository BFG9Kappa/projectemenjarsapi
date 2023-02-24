<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\Client;

class ClientsTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     * @group api
     **/
    public function llistat_carregue_correctament()
    {
        $clients = Client::factory()->count(5)->create();
        $response = $this->get('/api/clients');
        $response->assertStatus(200);
        foreach ($clients as $client) {
            $response->assertJsonFragment([
                'nom' => $client->nom,
                'cognoms' => $client->cognoms,
                'direccio' => $client->direccio,
                'telefon' => $client->telefon
            ]);
        }
    }

    /**
     * @test
     * @group api
     **/
    public function es_pot_crear_client()
    {
        $response = $this->post('/api/clients', [
            'nom' => 'Client',
            'cognoms' => 'Secret',
            'direccio' => 'Calle Falsa 123',
            'telefon' => '977000000'
        ]);
        $response->assertStatus(201);
        $this->assertDatabaseHas('clients', [
            'nom' => 'Client',
            'cognoms' => 'Secret',
            'direccio' => 'Calle Falsa 123',
            'telefon' => '977000000'
        ]);
    }

    /**
     * @test
     * @group api
     **/
    public function es_pot_mostrar_client()
    {
        $client = Client::factory()->create();
        $response = $this->get('/api/clients/' . $client->id);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'success',
            'message',
            'data' => [
                'id',
                'nom',
                'cognoms',
                'direccio',
                'telefon',
                'created_at',
                'updated_at'
            ]
        ]);
        $response->assertJson([
            'success' => true,
            'message' => 'Client recuperat',
            'data' => [
                'id' => $client->id,
                'nom' => $client->nom,
                'cognoms' => $client->cognoms,
                'direccio' => $client->direccio,
                'telefon' => $client->telefon,
                'created_at' => $client->created_at->toISOString(),
                'updated_at' => $client->updated_at->toISOString()
            ]
        ]);
    }

    /**
     * @test
     * @group api
     **/
    public function es_pot_actualitzar_client()
    {
        $client = Client::factory()->create();
        $response = $this->put("/api/clients/{$client->id}", [
            'nom' => 'Client',
            'cognoms' => 'actualitzat',
            'direccio' => 'Calle real 123',
            'telefon' => '800111222',
        ]);
        $response->assertStatus(200);
        $this->assertDatabaseHas('clients', [
            'id' => $client->id,
            'cognoms' => 'actualitzat',
            'direccio' => 'Calle real 123',
            'telefon' => '800111222',
        ]);
    }

    /**
     * @test
     * @group api
     **/
    public function es_pot_esborrar_client()
    {
        $client = Client::factory()->create();
        $response = $this->delete("/api/clients/{$client->id}");
        $response->assertStatus(200); // Tindrie que ser 204;
        $this->assertDatabaseMissing('clients', ['id' => $client->id]);
    }

}
