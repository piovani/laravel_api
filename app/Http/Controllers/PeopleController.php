<?php

namespace App\Http\Controllers;

use App\People;
use http\Env\Response;
use Illuminate\Http\Request;
use Webpatser\Uuid\Uuid;

class PeopleController extends Controller
{
    public function index()
    {
        $people = People::all();
        return Response()->json([
            'people' => $people
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|min:1|max:255',
            'last_name' => 'required|min:1|max:255',
            'bith_date' => 'required|date'
        ]);

        $people = new People();
        $people->id = (string) Uuid::generate();
        $people->first_name = $request->first_name;
        $people->last_name = $request->last_name;
        $people->bith_date = $request->bith_date;

        if (! $people->save()) {
            return $this->messageError();
        }

        return $this->messageSuccess();
    }

    public function show(String $id)
    {
        $people = People::find($id);

        if (! $people) {
            $this->messageError();
        }

        return Response()->json([
            'people' => $people
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);

        $people = People::find($request->id);

        if (! $people) {
            return $this->messageError();
        }

        $people->first_name = isset($request->first_name) ? $request->first_name : $people->first_name;
        $people->last_name = isset($request->last_name) ? $request->last_name : $people->last_name;
        $people->bith_date = isset($request->bith_date) ? $request->bith_date : $people->bith_date;

        if (! $people->save()) {
            return $this->messageError();
        }

        return $this->messageSuccess();
    }

    public function destroy(String $id)
    {
        $people = People::find($id);

        if (!$people || ! $people->delete()) {
            return $this->messageError();
        }

        return $this->messageSuccess();
    }

    protected function messageSuccess()
    {
        return Response()->json(['Messagem' => 'Operação efetuada com sucesso.'], 200);
    }

    protected function messageError()
    {
        return Response()->json(['Messagem' => 'Não foi possível efetuar a operação.'], 500);
    }
}
