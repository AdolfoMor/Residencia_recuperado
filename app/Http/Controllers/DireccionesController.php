<?php

namespace App\Http\Controllers;

use App\Models\Direcciones;
use Illuminate\Http\Request;
use App\Http\Requests\DireccionRequest;
use App\Http\Resources\DireccionResource;
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
    public function show(Request $request, $term)
    {
        $variable = Direcciones::where('Dirección', 'like', '%'.$term.'%')->get();
        return DireccionResource::collection($variable);
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
        $direcciones->Dirección = $request->input('Dirección');
        $direcciones->afiliado_fk = $request->input('afiliado_fk');
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
