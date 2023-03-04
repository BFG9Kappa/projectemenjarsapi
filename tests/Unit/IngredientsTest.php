<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class IngredientsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @group app
     **/
    public function carregue_llistat()
    {
        $response = $this->get('/ingredients');
        $response->assertStatus(200);
    }

}
