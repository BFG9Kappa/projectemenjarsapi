<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PlatsModuleTest extends TestCase
{
    /** @test */
    public function loads_plats_list_page()
    {
        $response = $this->get('/plats');
        $response->assertStatus(200);
    }

    /** @test */
    public function loads_plats_create_page()
    {
        $response = $this->get('/plats/create');
        $response->assertStatus(302); // Redirect al login
    }

    /** @test */
    public function loads_plats_show_page()
    {
        $response = $this->get('/plats/show');
        $response->assertStatus(404);
        //$response->assertOk();
    }

}
