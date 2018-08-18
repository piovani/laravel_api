<?php

namespace App\Http\Controllers;

use App\State;
use http\Env\Response;
use Illuminate\Http\Request;

class StateController extends Controller
{
    public function index()
    {
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
