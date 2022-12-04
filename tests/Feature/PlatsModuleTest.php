<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PlatsModuleTest extends TestCase
{
    /** @test */
    public function loads_the_plats_list_page()
    {
        $response = $this->get('/plats');
        $response->assertStatus(200);
    }
}
