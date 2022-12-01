<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Plat;

class PlatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$plats = Plat::all();
        $plats = Plat::paginate(5);
        return view('plats.index', compact('plats'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('plats.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*
        $request -> validate(
            [ 'nom' => 'required | min:3' ]
        );
        */ 
        $plats = new Plat;
        $plats -> nom = $request -> nom;
        $plats -> preu = $request -> preu;
        $plats -> save();
        return redirect()->route('plats.index')->with('success','Plat creat correctament.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Plat $plat)
    {
        return view('plats.show', compact('plat'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Plat $plat)
    {
        return view('plats.edit', compact('plat'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Plat $plat)
    {
        /*
        $request -> validate(
            [ 'nom' => 'required | min:3' ]
        );
        */ 
        $plat -> nom = $request -> nom;
        $plat -> preu = $request -> preu;
        $plat -> save();
        return redirect()->route('plats.index')->with('success','Plat actualitzat correctament.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Plat $plat)
    {
        /* Metode vell
        $plat = Plat::findOrFail($id);
        $plat -> delete();
        return redirect('/plats');
        */
        try {
            $result = $plat->delete();
        } catch(\Illuminate\Database\QueryException $e) {
            return redirect()->route('plats.index')->with('error','Error esborrant el plat.');
        }
        return redirect()->route('plats.index')->with('success','Plat esborrat correctament.');
    }
}
