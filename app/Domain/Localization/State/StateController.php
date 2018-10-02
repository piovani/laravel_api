<?php

namespace App\Http\Controllers;

use App\State;
use Illuminate\Http\Request;

class StateController extends Controller
{
    public function index(Request $request)
    {
        $data = State::all();

        return response($data);

        $data = State::filter()
            ->with('parent')
            ->paginate($request->get('rowsPerPage') ?: 20);

        return response($data);
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
