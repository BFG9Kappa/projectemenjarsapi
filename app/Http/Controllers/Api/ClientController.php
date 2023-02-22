<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Client;
use Validator;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$clients = Client::all(['id', 'nom', 'cognoms', 'direccio', 'telefon']);
        $clients = Client::paginate(5);
        $response = [
            'success' => true,
            'message' => "Llistat de clients recuperat",
            'data' => $clients,
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
                'nom' => 'required | min:3 | max:50',
                'cognoms' => 'required | min:3 | max:50',
                'direccio' => 'required | min:3 | max:200',
                'telefon' => 'required | numeric | digits_between:9,11'
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
        $client = Client::create($input);
        $response = [
            'success' => true,
            'message' => 'Alta correcta',
            'data' => $client,
        ];
        return response()->json($response, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $client = Client::find($id);
        if($client == null) {
            $response = [
              'success' => false,
              'message' => 'Client no trobat',
              'data' => [],
            ];
            return response()->json($response, 404);
        }
        else {
            $response = [
              'success' => true,
              'message' => 'Client recuperat',
              'data' => $client,
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
        $client = Client::find($id);
        if($client == null) {
            $response = [
                'success' => false,
                'message' => 'Client no recuperat',
                'data' => [],
            ];
            return response()->json($response,404);
        }
        $input = $request->all();
        $validator = Validator::make(
            $input,
            [
                'nom' => 'required | min:3 | max:50',
                'cognoms' => 'required | min:3 | max:50',
                'direccio' => 'required | min:3 | max:200',
                'telefon' => 'required | numeric | digits_between:9,11'
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
        //$client->update($input); // Rapida pero perillosa
        // Lenta pero segura
        $client->nom = $input['nom'];
        $client->cognoms = $input['cognoms'];
        $client->direccio = $input['direccio'];
        $client->telefon = $input['telefon'];
        $client->save();
        $response = [
            'success' => true,
            'message' => 'Client actualitzat correctament',
            'data' => $client,
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
        $client = Client::find($id);
        if($client == null){
            $response = [
                'success' => false,
                'message' => 'Client no recuperat',
                'data' => [],
            ];
            return response()->json($response,404);
        }
        try {
            $client->delete();
            $response = [
                'success' => true,
                'message' => 'Client esborrat',
                'data' => $client,
            ];
            return response()->json($response,200);
        } catch(\Excepetion $e) {
            $response = [
                'success' => false,
                'message' => 'Error esborrant el client',
            ];
            return response()->json($response,400);
        }
    }
}
