<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class IngredientsModuleTest extends TestCase
{
    /** @test */
    public function loads_ingredients_list_page()
    {
        $response = $this->get('/ingredients');
        $response->assertStatus(200);
    }
}
