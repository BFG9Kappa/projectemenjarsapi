<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Comanda;

class ComandaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comandes = Comanda::paginate(5);
        return view('comandes.index', compact('comandes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('comandes.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Afegir validacio
        $comandes = new Comanda;
        $comandes -> preu = $request -> preu;
        $comandes -> estat = $request -> estat;
        $comandes -> save();
        return redirect('/comandes');
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
        $comanda = Comanda::findOrFail($id);
        return view('comandes.update', compact('comanda'));
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
        $comanda = Comanda::findOrFail($id);
        /*
        $request -> validate(
            [ 'nom' => 'required | min:3' ]
        );
        */ 
        $comanda -> preu = $request -> preu;
        $comanda -> save();
        return redirect('/comandes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comanda = Comanda::findOrFail($id);
        $comanda -> delete();
        return redirect('/comandes');
    }
}
