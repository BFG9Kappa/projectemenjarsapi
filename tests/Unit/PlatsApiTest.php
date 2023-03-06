<?php

namespace Tests\Unit;

use Tests\TestCase;

class PlatsApiTest extends TestCase
{

    /**
     * @test
     * @group api
     **/
    public function carregue_llistat()
    {
        $response = $this->get('/api/plats');
        $response->assertStatus(200);
    }

    /**
     * @test
     * @group api
     **/
    public function no_carregue_llistat_paginat()
    {
        $response = $this->get('/api/plats?page=1');
        $response->assertStatus(200);
    }

}
