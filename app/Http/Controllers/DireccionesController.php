<?php

namespace App\Http\Controllers;

use App\Models\Direcciones;
use App\Models\Afiliado;
use Illuminate\Http\Request;
use App\Http\Requests\DireccionRequest;
use App\Http\Resources\DireccionResource;
use App\Http\Resources\AfiliadoResource;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;

class DireccionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $direcciones = Direcciones ::get(); 
        return DireccionResource::collection($direcciones);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DireccionRequest $request)
    {
        $direcciones = Direcciones::create($request->all());
        $direcciones->save();
        return new DireccionResource($direcciones);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Direcciones  $direcciones
     * @return \Illuminate\Http\Response
     */
    public function show(string $id)
    {
        $direcciones = Direcciones::whereafiliado_id($id)->get();
        return new DireccionResource($direcciones);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Direcciones  $direcciones
     * @return \Illuminate\Http\Response
     */
    public function edit(Direcciones $direcciones)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Direcciones  $direcciones
     * @return \Illuminate\Http\Response
     */
    public function update(DireccionRequest $request, string $id)
    {
        $direcciones = Direcciones::find($id);
        $direcciones->Estado = $request->input('Estado');
        $direcciones->Ciudad = $request->input('Ciudad');
        $direcciones->Calle = $request->input('Calle');
        $direcciones->Numero = $request->input('Numero');
        $direcciones->Colonia = $request->input('Colonia');
        $direcciones->Telefono = $request->input('Telefono');
        $direcciones->afiliado_id = $request->input('afiliado_id');
        $direcciones->save();

        return new DireccionResource($direcciones);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Direcciones  $direcciones
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $id)
    {
        $direcciones = Direcciones::find($id);

        Direcciones::destroy($id);
    }
}
