<?php

namespace App\Http\Controllers;

use App\State;
use http\Env\Response;
use Illuminate\Http\Request;

class StateController extends Controller
{
    public function index(Request $request)
    {
        //PAGINAÇÃO DEVE SER FEITA UTILIZANDO AS TECNICAS DO LARAVEL
//        $pagina = isset($request->pag) ? $request->pag : 1;
//        $limit = isset($request->limit) ? $request->limit : 20;

        $states = State::all();
        return Response()->json([
            "states" => $states
        ]);
    }

    public function show(String $id)
    {
        $state = State::find($id);

        if (! $state) {
            return $this->messageError();
        }

        return Response()->json([
            "states" => $state
         ]);
    }

    protected function messageError()
    {
        return Response()->json(['Messagem' => 'Não foi possível efetuar a operação.'], 500);
    }
}
