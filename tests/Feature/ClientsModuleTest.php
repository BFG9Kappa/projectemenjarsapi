<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ClientsModuleTest extends TestCase
{
    /** @test */
    public function loads_clients_list_page()
    {
        $response = $this->get('/clients');
        $response->assertStatus(302);
    }

}
