<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Client;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::paginate(5);
        return view('clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clients.create');
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
            'nom' => 'required | min:3 | max:50',
            'cognoms' => 'required | min:3 | max:50',
            'direccio' => 'required | min:3 | max:200',
            'telefon' => 'required | numeric | digits_between:9,11'
        ]);
        $clients = new Client;
        $clients -> nom = $request -> nom;
        $clients -> cognoms = $request -> cognoms;
        $clients -> direccio = $request -> direccio;
        $clients -> telefon = $request -> telefon;
        $clients -> save();
        return redirect()->route('clients.index')->with('success','Client creat correctament.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        return view('clients.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        $request -> validate([
            'nom' => 'required | min:3 | max:50',
            'cognoms' => 'required | min:3 | max:50',
            'direccio' => 'required | min:3 | max:200',
            'telefon' => 'required | numeric | digits_between:9,11'
        ]);
        $client -> nom = $request -> nom;
        $client -> cognoms = $request -> cognoms;
        $client -> direccio = $request -> direccio;
        $client -> telefon = $request -> telefon;
        $client -> save();
        return redirect()->route('clients.index')->with('success','Client actualitzat correctament.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        try {
            $result = $client->delete();
        } catch(\Illuminate\Database\QueryException $e) {
            return redirect()->route('clients.index')->with('error','Error esborrant el client.');
        }
        return redirect()->route('clients.index')->with('success','Client esborrat correctament.');
    }
}
