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

    /**
     * Display the specified resource.
     *
     * @param  \App\Curso  $curso
     * @return \Illuminate\Http\Response
     */
    public function show(Curso $curso)
    {
        return response($curso, 200);
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Curso  $curso
     * @return \Illuminate\Http\Response
     */
    public function destroy(Curso $curso)
    {
        $curso->deleted = true;
        $curso->save();

        return response(null, 204);
    }
}
