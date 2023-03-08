<?php

namespace Tests\Unit;

use Tests\TestCase;

class IngredientsApiTest extends TestCase
{

    /**
     * @test
     * @group api
     **/
    public function carregue_llistat()
    {
        $response = $this->get('/api/ingredients');
        $response->assertStatus(200);
    }

    /**
     * @test
     * @group api
     **/
    public function no_carregue_llistat_paginat()
    {
        $response = $this->get('/api/ingredients?page=1');
        $response->assertStatus(200);
    }

}
