<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Validator;
use Response;
use App\ModeloProvincias;
use View;
use App\ModeloPais;
use DB;
class ProvinciasControl extends Controller
{
    
protected $rules =
    [
        'nombreprovincias' => 'required',
        'codigoprovincias' => 'required',
        'idpais' => 'required',
    ];

    public function index()
    {
        $posts = DB::statement('CALL mostrarprovincias');
        $paises = ModeloPais::all();
        return view('provincias.index', ['posts' => $posts],['paises'=>$paises]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make(Input::all(), $this->rules);
        if ($validator->fails()) {
            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
        } else {
            $post = new ModeloProvincias();
            $post->CodigoProvincias = $request->codigoprovincias;
            $post->NombreProvincias = $request->nombreprovincias;
          	$post->idpais=$request->idpais;
            $post->save();
            return response()->json($post);
        }
    }

    public function show($id)
    {
        $post = ModeloProvincias::findOrFail($id);
        return view('pais.show', ['post' => $post]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make(Input::all(), $this->rules);
        if ($validator->fails()) {
            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
        } else {
            $post = ModeloProvincias::findOrFail($id);
            $post->CodigoProvincias = $request->codigoprovincias;
            $post->NombreProvincias = $request->nombreprovincias;
          	$post->idpais=$request->idpais;
            $post->save();

            return response()->json($post);
        }
    }

    public function destroy($id)
    {
        $post = ModeloProvincias::findOrFail($id);
        $post->delete();
        return response()->json($post);
    }
}
