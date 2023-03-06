<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\User;

use App\Models\Client;

class ClientsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @group app
     **/
    public function no_carregue_llistat()
    {
        $response = $this->get('/clients');
        $response->assertStatus(302);
    }

    /**
     * @test
     * @group app
     **/
    public function carregue_llistat_com_admin()
    {
        $user = User::factory()->create(['role_id' => 1]);
        $response = $this->actingAs($user)->get('/clients');
        $response->assertStatus(200);
        $response->assertViewIs('clients.index');
    }

    /**
     * @test
     * @group app
     **/
    public function no_carregue_crear()
    {
        $response = $this->get('/clients/create');
        $response->assertStatus(302);
    }

    /**
     * @test
     * @group app
     **/
    public function carregue_crear_com_admin()
    {
        $user = User::factory()->create(['role_id' => 1]);
        $response = $this->actingAs($user)->get('/clients/create');
        $response->assertStatus(200);
        $response->assertViewIs('clients.create');
    }

    /**
     * @test
     * @group app
     **/
    public function no_carregue_modificar()
    {
        $response = $this->get('/clients/edit/1');
        $response->assertStatus(302);
    }

    /**
     * @test
     * @group app
     **/
    public function carregue_modificar_com_admin()
    {
        $user = User::factory()->create(['role_id' => 1]);
        $client = Client::factory()->create();
        $response = $this->actingAs($user)->get('/clients/edit/1');
        $response->assertStatus(200);
    }

    /**
     * @test
     * @group app
     **/
    public function no_carregue_esborrar()
    {
        $response = $this->get('/clients/destroy/1');
        $response->assertStatus(302);
    }

}
