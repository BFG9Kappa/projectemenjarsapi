<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\User;

use App\Models\Comanda;

class ComandesTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @group app
     **/
    public function no_carregue_llistat()
    {
        $response = $this->get('/comandes');
        $response->assertStatus(302);
    }

    /**
     * @test
     * @group app
     **/
    public function carregue_llistat_com_admin()
    {
        $user = User::factory()->create(['role_id' => 1]);
        $response = $this->actingAs($user)->get('/comandes');
        $response->assertStatus(200);
        $response->assertViewIs('comandes.index');
    }

    /**
     * @test
     * @group app
     **/
    public function no_carregue_crear()
    {
        $response = $this->get('/comandes/create');
        $response->assertStatus(302);
    }

    /**
     * @test
     * @group app
     **/
    public function carregue_crear_com_admin()
    {
        $user = User::factory()->create(['role_id' => 1]);
        $response = $this->actingAs($user)->get('/comandes/create');
        $response->assertStatus(200);
        $response->assertViewIs('comandes.create');
    }

    /**
     * @test
     * @group app
     **/
    public function no_carregue_modificar()
    {
        $response = $this->get('/comandes/edit/1');
        $response->assertStatus(302);
    }

    /**
     * @test
     * @group app
     **/
    public function carregue_modificar_com_admin()
    {
        $user = User::factory()->create(['role_id' => 1]);
        $comanda = Comanda::factory()->create();
        $response = $this->actingAs($user)->get('/comandes/edit/1');
        $response->assertStatus(200);
    }

    /**
     * @test
     * @group app
     **/
    public function no_carregue_esborrar()
    {
        $response = $this->get('/comandes/destroy/1');
        $response->assertStatus(302);
    }

}
