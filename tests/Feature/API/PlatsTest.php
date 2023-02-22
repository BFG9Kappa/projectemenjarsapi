<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PlatsTest extends TestCase
{

    /** @test */
    public function loads_api_plats_list_page()
    {
        $response = $this->get('/api/plats');
        $response->assertStatus(200);
    }

    /** @test */
    /* CAMBIAR ESTO
    public function insert_plat()
    {
        $response = $this->json('POST', '/api/ingredients', [
        'nom' => 'Spaghetti Bolognese',
        'preu' => '15'

    ]);

    $response->assertStatus(201); // Verifica que la solicitud se haya realizado correctamente
    $response->assertJsonFragment(['nom' => 'Spaghetti Bolognese']); // Verifica que la respuesta incluye los datos esperados
    }

    */
}
