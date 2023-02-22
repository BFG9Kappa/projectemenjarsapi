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
        // Crear 5 ingredientes de prueba
        $ingredients = Ingredient::factory()->count(5)->create();
        // Hacer una petición GET a la API para obtener todos los ingredientes
        $response = $this->get('/api/ingredients');
        // Comprobar que se devuelve una respuesta exitosa
        $response->assertStatus(200);
        // Comprobar que se muestran los nombres de todos los ingredientes
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
        // Hacer una petición POST para crear un usuario
        $response = $this->post('/api/ingredients', [
            'nom' => 'Ingredient secret',
        ]);
        // Comprobar que se devuelve el código de respuesta correcto
        $response->assertStatus(201);
        // Comprobar que el usuario ha sido creado en la base de datos
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
        // Crear un ingrediente
        $ingredient = Ingredient::factory()->create();
        // Hacer una petición GET a la ruta para mostrar el ingrediente
        $response = $this->get('/api/ingredients/' . $ingredient->id);
        // Verificar que la respuesta tiene el código HTTP 200
        $response->assertStatus(200);
        // Verificar que la respuesta tiene el formato correcto
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
        // Verificar que la respuesta contiene la información correcta del ingrediente
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
        // Crear un usuario de prueba
        $ingredient = Ingredient::factory()->create();
        // Hacer una petición PUT para actualizar el usuario
        $response = $this->put("/api/ingredients/{$ingredient->id}", [
            'nom' => 'Ingredient actualitzat',
        ]);
        // Comprobar que se devuelve el código de respuesta correcto
        $response->assertStatus(200);
        // Comprobar que el usuario ha sido actualizado en la base de datos
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
        // Crear un usuario de prueba
        $ingredient = Ingredient::factory()->create();
        // Hacer una petición DELETE para eliminar el usuario
        $response = $this->delete("/api/ingredients/{$ingredient->id}");
        // Comprobar que se devuelve el código de respuesta correcto
        $response->assertStatus(200); // Tindrie que ser 204;
        // Comprobar que el usuario ha sido eliminado de la base de datos
        $this->assertDatabaseMissing('ingredients', ['id' => $ingredient->id]);
    }


}
