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
        return view('plats.new');
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
        return redirect('/plats');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $plat = Plat::findOrFail($id);
        return view('plats.update', compact('plat'));
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
        $plat = Plat::findOrFail($id);
        /*
        $request -> validate(
            [ 'nom' => 'required | min:3' ]
        );
        */ 
        $plat -> nom = $request -> nom;
        $plat -> preu = $request -> preu;
        $plat -> save();
        return redirect('/plats');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $plat = Plat::findOrFail($id);
        $plat -> delete();
        return redirect('/plats');
    }
}
