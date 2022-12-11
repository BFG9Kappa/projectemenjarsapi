<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Ingredient;

class IngredientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$ingredients = Ingredient::all();
        $ingredients = Ingredient::paginate(5);
        return view('ingredients.index', compact('ingredients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ingredients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request -> validate([
            'nom' => 'required | min:3 | max:30'
        ]);
        $ingredients = new Ingredient;
        $ingredients -> nom = $request -> nom;
        $ingredients -> save();
        return redirect()->route('ingredients.index')->with('success','Ingredient creat correctament.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Ingredient $ingredient)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Ingredient $ingredient)
    {
        return view('ingredients.edit', compact('ingredient'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ingredient $ingredient)
    {
        $request -> validate([
            'nom' => 'required | min:3 | max:30'
        ]);
        $ingredient -> nom = $request -> nom;
        $ingredient -> save();
        return redirect()->route('ingredients.index')->with('success','Ingredient actualitzat correctament');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ingredient $ingredient)
    {
        try {
            $result = $ingredient->delete();
        } catch(\Illuminate\Database\QueryException $e) {
            return redirect()->route('ingredients.index')->with('error','Error esborrant el ingredient');
        }
        return redirect()->route('ingredients.index')->with('success','Ingredient esborrat correctament.');
    }
}
