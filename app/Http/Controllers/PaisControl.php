<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Validator;
use Response;
use App\ModeloPais;
use View;
class PaisControl extends Controller
{

protected $rules =
    [
        'codigopais' => 'required',
        'nombrepais' => 'required'
    ];

    public function index()
    {
        $posts = ModeloPais::all();
        return view('pais.index', ['posts' => $posts]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make(Input::all(), $this->rules);
        if ($validator->fails()) {
            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
        } else {
            $post = new ModeloPais();
            $post->CodigoPais = $request->codigopais;
            $post->NombrePais = $request->nombrepais;
            $post->save();
            return response()->json($post);
        }
    }

    public function show($id)
    {
        $post = ModeloPais::findOrFail($id);
        return view('pais.show', ['post' => $post]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make(Input::all(), $this->rules);
        if ($validator->fails()) {
            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
        } else {
            $post = ModeloPais::findOrFail($id);
            $post->CodigoPais = $request->codigopais;
            $post->NombrePais = $request->nombrepais;
            $post->save();
            return response()->json($post);
        }
    }

    public function destroy($id)
    {
        $post = ModeloPais::findOrFail($id);
        $post->delete();
        return response()->json($post);
    }

}
