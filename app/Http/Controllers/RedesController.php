<?php

namespace App\Http\Controllers;

use App\Models\Redes;
use Illuminate\Http\Request;
use App\Http\Requests\RedesRequest;
use App\Http\Resources\RedesResource;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;

class RedesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $redes = Redes ::get(); 
        return RedesResource::collection($redes);
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
    public function store(Request $request)
    {
        $redes = Redes::create($request->all());
        $redes->save();
        return new RedesResource($redes);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(string $id)
    {
        $redes = Redes::whereestructura_id($id)->get();
        return new RedesResource($redes);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RedesRequest $request, string $id)
    {
        $redes = Redes::find($id);
        $redes->Facebook = $request->input('Facebook');
        $redes->Instagram = $request->input('Instagram');
        $redes->Linkedin = $request->input('Linkedin');
        $redes->Twitter = $request->input('Twitter');
        $redes->Google = $request->input('Google');
        $redes->estructura_id = $request->input('estructura_id');
        $redes->save();

        return new RedesResource($redes);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $redes = Redes::find($id);

        Redes::destroy($id);
    }
}
