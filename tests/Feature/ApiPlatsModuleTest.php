<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ApiPlatsModuleTest extends TestCase
{

    /** @test */
    public function loads_api_plats_list_page()
    {
        $response = $this->get('/api/plats');
        $response->assertStatus(200);
    }

}
