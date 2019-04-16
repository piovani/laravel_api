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
            'people' => $people,
        ]);
    }

    public function show(String $id)
    {
        $people = People::findOrFail($id);

        return Response()->json([
            'people' => $people,
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);

        $people             = People::findOrFail($request->id);
        $people->first_name = isset($request->first_name) ? $request->first_name : $people->first_name;
        $people->last_name  = isset($request->last_name)  ? $request->last_name  : $people->last_name;
        $people->bith_date  = isset($request->bith_date)  ? $request->bith_date  : $people->bith_date;

        if (!$people->save()) return $this->messageResponse( 500);

        $this->messageResponse(200);
    }

    public function destroy(String $id)
    {
        $people = People::findOrFail($id);

        if (!$people->delete()) return $this->messageResponse(500);

        return $this->messageSuccess(200);
    }
}
