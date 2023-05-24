<?php

namespace App\Http\Controllers;

use App\Models\Afiliado;
use Illuminate\Http\Request;
use App\Http\Requests\AfiliadoRequest;
use App\Http\Resources\AfiliadoResource;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;

class AfiliadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $afiliados = Afiliado::get(); 
        return AfiliadoResource::collection($afiliados);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AfiliadoRequest $request)
    {
        $afiliado = Afiliado::create($request->all());
        $afiliado->save();
        return new AfiliadoResource($afiliado);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Afiliado  $afiliado
     * @return \Illuminate\Http\Response
     */
    public function show(Afiliado $afiliado)
    {
        $afiliado = Afiliado::find($id);
        return new AfiliadoResource($afiliado);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Afiliado  $afiliado
     * @return \Illuminate\Http\Response
     */
    public function edit(Afiliado $afiliado)
    {
    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Afiliado  $afiliado
     * @return \Illuminate\Http\Response
     */
    public function update(AfiliadoRequest $request, string $id)
    {
        $afiliado = Afiliado::find($id);
        $afiliado->update(['Nombre' => $request['Nombre'], 'RFC' => $request['RFC'], 'Estado' => $request['Estado'] ]);
        return new AfiliadoResource($afiliado);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Afiliado  $afiliado
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $id)
    {
        Afiliado::destroy($id);
        return response()->json(['success' => 'Deleted Succesfully']);
    }
}
