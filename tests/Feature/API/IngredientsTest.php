<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\Ingredient;

class IngredientsTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     * @group api
     **/
    public function llistat_carregue_correctament()
    {
        // Crear ingredientes de prova
        $ingredients = Ingredient::factory()->count(5)->create();
        // Fer peticio GET a la API per obtenir tots els ingredients
        $response = $this->get('/api/ingredients');
        // Comprovar que es torni una resposta exitosa
        $response->assertStatus(200);
        // Comprovar que es mostrin els noms de tots els ingredients
        foreach ($ingredients as $ingredient) {
            $response->assertJsonFragment([
                'nom' => $ingredient->nom
            ]);
        }
    }

    /**
     * @test
     * @group api
     **/
    public function es_pot_crear_ingredient()
    {
        // Fer una peticio POST per crear un ingredient
        $response = $this->post('/api/ingredients', [
            'nom' => 'Ingredient secret',
        ]);
        // Comprovar que es torni una resposta exitosa
        $response->assertStatus(201);
        // Comprovar que el ingredient s’ha creat en la base de dades
        $this->assertDatabaseHas('ingredients', [
            'nom' => 'Ingredient secret',
        ]);
    }

    /**
     * @test
     * @group api
     **/
    public function es_pot_mostrar_ingredient()
    {
        // Crear un ingredient
        $ingredient = Ingredient::factory()->create();
        // Fer una peticio GET a la ruta para mostrar el ingredient
        $response = $this->get('/api/ingredients/' . $ingredient->id);
        // Verificar que la resposta te el codi HTTP 200
        $response->assertStatus(200);
        // Verificar que la resposta te el format correcte
        $response->assertJsonStructure([
            'success',
            'message',
            'data' => [
                'id',
                'nom',
                'created_at',
                'updated_at'
            ]
        ]);
        // Verificar que la resposta conte la informacio correcta del ingredient
        $response->assertJson([
            'success' => true,
            'message' => 'Ingredient recuperat',
            'data' => [
                'id' => $ingredient->id,
                'nom' => $ingredient->nom,
                'created_at' => $ingredient->created_at->toISOString(),
                'updated_at' => $ingredient->updated_at->toISOString()
            ]
        ]);
    }

    /**
     * @test
     * @group api
     **/
    public function es_pot_actualitzar_ingredient()
    {
        // Crear un ingredient de prova
        $ingredient = Ingredient::factory()->create();
        // Fer una peticio PUT per actualitzar el ingredient
        $response = $this->put("/api/ingredients/{$ingredient->id}", [
            'nom' => 'Ingredient actualitzat',
        ]);
        // Comprovar que es torni una resposta exitosa
        $response->assertStatus(200);
        // Comprovar que el ingredient s’ha actualitzat en la base de dades
        $this->assertDatabaseHas('ingredients', [
            'id' => $ingredient->id,
            'nom' => 'Ingredient actualitzat',
        ]);
    }

    /**
     * @test
     * @group api
     **/
    public function es_pot_esborrar_ingredient()
    {
        // Crear un ingredient de prova
        $ingredient = Ingredient::factory()->create();
        // Fer una peticio DELETE per eliminar el ingredient
        $response = $this->delete("/api/ingredients/{$ingredient->id}");
        // Comprovar que es torne el codi de resposta correcte
        $response->assertStatus(200); // Tindrie que ser 204;
        // Comprovar que el ingredient s’ha eliminat de la base de dades
        $this->assertDatabaseMissing('ingredients', ['id' => $ingredient->id]);
    }

}
