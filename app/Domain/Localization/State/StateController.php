<?php

namespace App\Domain\Localization\State;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StateController extends Controller
{
    public function index(Request $request)
    {
        $states = State::filter()
            ->paginate(
                $request->get('limit', 15)
            );

        return response($states);
    }

//    public function show(String $id)
//    {
//        $state = State::find($id);
//
//        if (! $state) {
//            return $this->messageError();
//        }
//
//        return Response()->json([
//            "states" => $state
//         ]);
//    }
//
//    protected function messageError()
//    {
//        return Response()->json(['Messagem' => 'Não foi possível efetuar a operação.'], 500);
//    }
}
