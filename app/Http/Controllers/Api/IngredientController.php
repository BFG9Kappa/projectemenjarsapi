<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Ingredient;
use Validator;

class IngredientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$ingredients = Ingredient::all(['id','nom']); // Sense paginar
        $ingredients = Ingredient::paginate(5); // Per paginar
        $response = [
            'success' => true,
            'message' => "Llistat d'ingredients recuperat",
            'data' => $ingredients,
        ];
        return response()->json($response, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make(
            $input,
            [
                'nom' => 'required | min:3 | max:30'
            ]
        );
        if($validator->fails()) {
            $response = [
                'success' => false,
                'message' => "Error d'alta",
                'data' => $validator->errors()->all(),
            ];
            return response()->json($response, 400);
        }
        $ingredient = Ingredient::create($input);
        $response = [
            'success' => true,
            'message' => 'Alta correcta',
            'data' => $ingredient,
        ];
        return response()->json($response, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ingredient = Ingredient::find($id);
        if($ingredient == null) {
            $response = [
              'success' => false,
              'message' => 'Ingredient no trobat',
              'data' => [],
            ];
            return response()->json($response, 404);
        }
        else {
            $response = [
              'success' => true,
              'message' => 'Ingredient recuperat',
              'data' => $ingredient,
            ];
            return response()->json($response, 200);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $ingredient = Ingredient::find($id);
        if($ingredient == null) {
            $response = [
                'success' => false,
                'message' => 'Ingredient no recuperat',
                'data' => [],
            ];
            return response()->json($response,404);
        }
        $input = $request->all();
        $validator = Validator::make(
            $input,
            [
                'nom' => 'required | min:3 | max:30'
            ]
        );
        if($validator->fails()) {
            $response = [
                'success' => false,
                'message' => 'Error de validacio',
                'data' => $validator->errors(),
            ];
            return response()->json($response, 400);
        }
        $ingredient->nom = $input['nom'];
        $ingredient->save();
        $response = [
            'success' => true,
            'message' => 'Ingredient actualitzat correctament',
            'data' => $ingredient,
        ];
        return response()->json($response,200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ingredient = Ingredient::find($id);
        if($ingredient == null){
            $response = [
                'success' => false,
                'message' => 'Ingredient no recuperat',
                'data' => [],
            ];
            return response()->json($response,404);
        }
        try {
            $ingredient->delete();
            $response = [
                'success' => true,
                'message' => 'Ingredient esborrat',
                'data' => $ingredient,
            ];
            return response()->json($response,200); // Tindrie que ser 204, pero no acabe de anar del tot bé.
        } catch(\Excepetion $e) {
            $response = [
                'success' => false,
                'message' => 'Error esborrant el ingredient',
            ];
            return response()->json($response,400);
        }
    }
}
