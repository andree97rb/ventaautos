<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Models\Auto;

class AutoController extends Controller
{
    public function index()
    {
        $auto=Cache::remember('cacheauto',20/60, function()
        {
            return Auto::all();
        });

        return response()->json(['status'=>'ok','data'=>$auto], 200);
    }

    public function store(Request $request)
    {
        if (!$request->modelo || !$request->placa || !$request->color|| $request->idMarca == 0)
		{         
			return response()->json(['errors'=>array(['code'=>422,'message'=>'Faltan datos para acceder a su solicitud.'])], 422);
        }

        $nuevoAuto=Auto::create($request->all());

        return response()->json(['data'=>$nuevoAuto], 201)->header('Location', url('/api/v1/').'/auto/'.$nuevoAuto->id);
    }

    public function show($id)
    {
        $auto=Auto::find($id);

		if (!$auto)
		{
			return response()->json(['errors'=>array(['code'=>404,'message'=>'No se encontró ningún auto con este código.'])], 404);
		}

        return response()->json(['status'=>'ok','data'=>$auto], 200);
    }

    public function update(Request $request, $id)
	{
		$auto=Auto::find($id);

		if (!$auto)
		{
			return response()->json(['errors'=>array(['code'=>404,'message'=>'No se encontró ningún auto con este código.'])], 404);
		}

		$modelo=$request->modelo;
		$placa=$request->placa;
		$color=$request->color;
		$idMarca=$request->idMarca;		
		
		if (!$modelo || !$placa || !$color || $idMarca == 0)
		{
			return response()->json(['errors'=>array(['code'=>422,'message'=>'Faltan valores para completar el procesamiento.'])],422);
		}

		$auto->modelo=$modelo;
		$auto->placa=$placa;
		$auto->color=$color;
		$auto->idMarca=$idMarca;

		$auto->save();
		return response()->json(['status'=>'ok','data'=>$auto], 200);
	}
}