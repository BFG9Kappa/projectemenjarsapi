<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Plat;
use Validator;

class PlatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$plats = Plat::all(['id', 'nom', 'preu']);
        $plats = Plat::paginate(5); // Per paginar
        $response = [
            'success' => true,
            'message' => "Llistat de plats recuperat",
            'data' => $plats,
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
                'preu' => ['required', 'numeric', 'regex:/^\d{0,4}+(\.\d{1,2})?$/'],
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
        $plat = Plat::create($input);
        $response = [
            'success' => false,
            'message' => 'Alta correcta',
            'data' => $plat,
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
        $plat = Plat::find($id);
        if($plat == null) {
            $response = [
              'success' => false,
              'message' => 'Plat no trobat',
            ];
            return response()->json($response, 404); 
        }
        else {
            $response = [
              'success' => true,
              'message' => 'Plat recuperat',
              'data' => [],
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
        $plat = Plat::find($id);
        if($plat == null) {
            $response = [
                'success' => false,
                'message' => 'Plat no recuperat',
                'data' => [],
            ];
            return response()->json($response,404);
        }
        $input = $request->all();
        $validator = Validator::make(
            $input,
            [
                'nom' => 'required | min:3 | max:50',
                'preu' => ['required', 'numeric', 'regex:/^\d{0,4}+(\.\d{1,2})?$/']
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
        $plat->nom = $input['nom'];
        $plat->preu = $input['preu'];
        $plat->save();
        $response = [
            'success' => true,
            'message' => 'Plat actualitzat correctament',
            'data' => $plat,
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
        $plat = Plat::find($id);
        if($plat == null){
            $response = [
                'success' => false,
                'message' => 'Plat no recuperat',
                'data' => [],
            ];
            return response()->json($response,404);
        }
        try {
            $plat->delete();
            $response = [
                'success' => true,
                'message' => 'Plat esborrat',
                'data' => $plat,
            ];
            return response()->json($response,200);
        } catch(\Excepetion $e) {
            $response = [
                'success' => false,
                'message' => 'Error esborrant el plat',
            ];
            return response()->json($response,400);
        }
    }
}
