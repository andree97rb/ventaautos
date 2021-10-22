<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Models\Marca;

class MarcaController extends Controller
{
    public function index()
    {
        $marca=Cache::remember('cachemarca',20/60, function()
        {
            return Marca::all();
        });

        return response()->json(['status'=>'ok','data'=>$marca], 200);
    }

    public function store(Request $request)
    {
        if (!$request->nombre)
		{         
			return response()->json(['errors'=>array(['code'=>422,'message'=>'Faltan datos para acceder a su solicitud.'])], 422);
        }

        $nuevaMarca=Marca::create($request->all());

        return response()->json(['data'=>$nuevaMarca], 201)->header('Location', url('/api/v1/').'/marca/'.$nuevaMarca->id);
    }

    public function show($id)
    {
        $marca=Marca::find($id);

		if (!$marca)
		{
			return response()->json(['errors'=>array(['code'=>404,'message'=>'No se encontró ninguna marca con este código.'])], 404);
		}

        return response()->json(['status'=>'ok','data'=>$marca], 200);
    }

    public function update(Request $request, $id)
	{
		$marca=Marca::find($id);

		if (!$marca)
		{
			return response()->json(['errors'=>array(['code'=>404,'message'=>'No se encuentra ninguna marca con este código.'])], 404);
		}

		$nombre=$request->nombre;
		
		if (!$nombre)
		{
			return response()->json(['errors'=>array(['code'=>422,'message'=>'Faltan valores para completar el procesamiento.'])], 422);
		}

		$marca->nombre=$nombre;

		$marca->save();
		return response()->json(['status'=>'ok','data'=>$marca], 200);
	}
}