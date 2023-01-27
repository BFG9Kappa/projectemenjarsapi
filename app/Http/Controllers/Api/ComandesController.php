<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Comanda;
use Validator;

class ComandesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comandes = Comanda::all(['id','nom', 'preu', 'estat']);
        $response = [
            'success' => true,
            'message' => "Llistat de comandes recuperat",
            'data' => $comandes,
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
                'nom' => 'required | min:3 | max:20',
                //'preu' => 'required',
                //'estat' => 'required',
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
        $comanda = Comanda::create($input);
        $response = [
            'success' => false,
            'message' => 'Alta correcta',
            'data' => $comanda,
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
        $comanda = Comanda::find($id);
        if($comanda == null) {
            $response = [
              'success' => false,
              'message' => 'Comanda no trobada',
              'data' => [],  
            ];
            return response()->json($response, 404); 
        }
        else {
            $response = [
              'success' => true,
              'message' => 'Comanda recuperada',
              'data'    => $comanda,
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
        $comanda = Comanda::find($id);
        if($comanda == null) {
            $response = [
                'success' => false,
                'message' => 'Comanda no recuperada',
                'data' => [],
            ];
            return response()->json($response,404);
        }
        $input = $request->all();
        $validator = Validator::make(
            $input,
            [
                'nom' => 'required | min:3 | max:20',
                //'preu' => 'required',
                //'estat' => 'required',
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
        $comanda->nom = $input['nom'];
        $comanda->preu = $input['preu'];
        $comanda->save();
        $response = [
            'success' => true,
            'message' => 'Comanda actualitzada correctament',
            'data' => $comanda,
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
        $comanda = Comanda::find($id);
        if($comanda == null){
            $response = [
                'success' => false,
                'message' => 'Comanda no recuperada',
                'data' => [],
            ];
            return response()->json($response,404);
        }
        try {
            $comanda->delete();
            $response = [
                'success' => true,
                'message' => 'Comanda esborrada',
                'data' => $comanda,
            ];
            return response()->json($response,200);
        } catch(\Excepetion $e) {
            $response = [
                'success' => false,
                'message' => 'Error esborrant la comanda',
            ];
            return response()->json($response,400);
        }
    }
}
