<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Comanda;
use App\Models\Plat;

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
        return view('comandes.create');
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
            'nom' => 'required | min:3'
        ]);
        $comandes = new Comanda;
        $comandes -> nom = $request -> nom;
        //$comandes -> preu = $request -> preu;
        //$comandes -> estat = $request -> estat;
        $comandes -> save();
        return redirect()->route('comandes.index')->with('success','Comanda creada correctament.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Comanda $comanda)
    {
        return view('comandes.show', compact('comanda'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Comanda $comanda)
    {
        return view('comandes.edit', compact('comanda'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comanda $comanda)
    {
        $request -> validate([
            'nom' => 'required | min:3',
            'preu' => 'required | numeric'
        ]);
        $comanda -> nom = $request -> nom;
        $comanda -> preu = $request -> preu;
        $comanda -> estat = $request -> estat;
        $comanda -> save();
        return redirect()->route('comandes.index')->with('success','Comanda actualitzada correctament.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comanda $comanda)
    {
        try {
            $result = $comanda->delete();
        } catch(\Illuminate\Database\QueryException $e) {
            return redirect()->route('comandes.index')->with('error','Error esborrant la comanda.');
        }
        return redirect()->route('comandes.index')->with('success','Comanda esborrada correctament.');
    }

    public function editPlats(Comanda $comanda)
    {
        $arrayId = $comanda->plat->pluck('id');
        $plats = Plat::whereNotIn('id', $arrayId)->get();
        return view('comandes.showPlats', compact('comanda','plats'));
    }

    public function attachPlats(Request $request, Comanda $comanda)
    {
        $request->validate([
            'plats' => 'exists:plats,id',                       
        ]);
       $comanda->plat()->attach($request->plats);
       return redirect()->route('comandes.editplats',$comanda->id)->with('success','Plats afegits correctament');
    }

    public function detachPlats(Request $request, Comanda $comanda)
    {
        $request->validate([
            'plats' => 'exists:plats,id',                       
        ]);
        if ($request->has('plats'))
            $comanda->plat()->detach($request->plats);
        return redirect()->route('comandes.editplats',$comanda->id)->with('success','Plats trets correctament');
    }
}
