<?php

namespace Tests\Unit;

use Tests\TestCase;

use App\Models\Plat;

class PlatsTest extends TestCase
{

    /**
     * @test
     * @group app
     **/
    public function carregue_llistat()
    {
        $response = $this->get('/plats');
        $response->assertStatus(200);
    }

    /**
     * @test
     * @group app
     **/
    public function carregue_crear_plats()
    {
        $response = $this->get('/plats/create');
        $response->assertStatus(302); // Redirect al login
    }

    /**
     * @test
     * @group app
     **/
    public function carregue_mostrar_plat()
    {
        $plat = Plat::factory()->create();
        $response = $this->get('/plats/show/1');
        $response->assertStatus(200);
    }

}
