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

}
