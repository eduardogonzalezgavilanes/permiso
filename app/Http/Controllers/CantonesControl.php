<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Validator;
use Response;
use App\ModeloCantones;
use View;
use App\ModeloProvincias;
use DB;
class CantonesControl extends Controller
{
        
protected $rules =
    [
        'nombrecantones' => 'required',
        'codigocantones' => 'required',
        'idprovincias' => 'required',
    ];

    public function index()
    {
         $posts = DB::table('vCantones')->get();
        $provincias = ModeloProvincias::all();
        return view('cantones.index', ['posts' => $posts],['provincias'=>$provincias]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make(Input::all(), $this->rules);
        if ($validator->fails()) {
            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
        } else {
            $post = new ModeloCantones();
            $post->CodigoCantones= $request->codigocantones;
            $post->NombreCantones = $request->nombrecantones;
            $post->idprovincias=$request->idprovincias;
            $post->save();
            return response()->json($post);
        }
    }

    public function show($id)
    {
        $post = ModeloCantones::findOrFail($id);
        return view('cantones.show', ['post' => $post]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make(Input::all(), $this->rules);
        if ($validator->fails()) {
            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
        } else {
            $post = ModeloCantones::findOrFail($id);
             $post->CodigoCantones= $request->codigocantones;
            $post->NombreCantones = $request->nombrecantones;
            $post->idprovincias=$request->idprovincias;
            $post->save();

            return response()->json($post);
        }
    }

    public function destroy($id)
    {
        $post = ModeloCantones::findOrFail($id);
        $post->delete();
        return response()->json($post);
    }

}
