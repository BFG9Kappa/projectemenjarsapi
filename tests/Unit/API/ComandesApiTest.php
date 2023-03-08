<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;

class ComandesApiTest extends TestCase
{

    /**
     * @test
     * @group api
     **/
    public function no_carregue_llistat()
    {
        $response = $this->get('/api/comandes');
        $response->assertStatus(302);
    }

    /**
     * @test
     * @group api
     **/
    public function no_carregue_llistat_paginat()
    {
        $response = $this->get('/api/comandes?page=1');
        $response->assertStatus(302);
    }

    /**
     * @test
     * @group api
     **/
    public function carregue_llistat_com_admin()
    {
        $user = User::factory()->create(['role_id' => 1]);
        $response = $this->actingAs($user)->get('/api/comandes');
        $response->assertStatus(200);
    }

    /**
     * @test
     * @group api
     **/
    public function carregue_llistat_paginat_com_admin()
    {
        $user = User::factory()->create(['role_id' => 1]);
        $response = $this->actingAs($user)->get('/api/comandes?page=1');
        $response->assertStatus(200);
    }

}
