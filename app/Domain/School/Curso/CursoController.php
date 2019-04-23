<?php

namespace App\Domain\School\Curso;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Domain\School\Curso\CursoResource;

class CursoController extends Controller
{
    public function index(Request $request)
    {
        return CursoResource::collection(
            Curso::where('name', 'like', "%{$request->search}%")
                ->paginate()
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this
            ->service
            ->store($request);

        return response($data, 201);
    }

    public function show(Curso $curso)
    {
        return new CursoResource($curso);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Curso  $curso
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Curso $curso)
    {
        $data = $this
            ->service
            ->update($curso, $request);

        return response($data);
    }

    public function destroy(Curso $curso)
    {
        $curso->delete();

        return response(null, 204);
    }
}
