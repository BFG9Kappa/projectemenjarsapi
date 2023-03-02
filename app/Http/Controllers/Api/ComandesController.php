<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Comanda;
use App\Models\Plat;
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
        //$comandes = Comanda::all(['id','nom', 'preu', 'estat']);
        $comandes = Comanda::paginate(5);
        //$comandes->load('plats');
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
                'preu' => ['required', 'numeric', 'regex:/^\d{0,4}+(\.\d{1,2})?$/'],
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
            'success' => true,
            'message' => 'Alta correcta',
            'data' => $comanda,
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
              'data' => $comanda,
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
                'preu' => ['required', 'numeric', 'regex:/^\d{0,4}+(\.\d{1,2})?$/'],
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
        $comanda->estat = $input['estat'];
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


    public function editPlats($id)
    {
        $comanda = Comanda::find($id);
        $arrayId = $comanda->plat->pluck('id');
        $plats = Plat::whereNotIn('id', $arrayId)->get();
        $response = [
            'success' => true,
            'comanda' => $comanda,
            'plats'=>$plats
        ];
        return response()->json($response,200);
    }
}
