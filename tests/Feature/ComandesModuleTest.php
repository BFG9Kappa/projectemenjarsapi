<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ComandesModuleTest extends TestCase
{
    /** @test */
    public function loads_comandes_list_page()
    {
        $response = $this->get('/comandes');
        $response->assertStatus(302);
    }
}
