<?php

namespace App\Http\Controllers;

use App\Models\Estructura;
use Illuminate\Http\Request;
use App\Http\Requests\EstructuraRequest;
use App\Http\Resources\EstructuraResource;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;

class EstructuraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $estructura = Estructura ::get(); 
        return EstructuraResource::collection($estructura);
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
    public function store(EstructuraRequest $request)
    {
        $estructura = Estructura::create($request->all());
        if($request->hasFile('Foto')){
            $fileName = time().$request->file('Foto')->getClientOriginalName();
            $path = $request->file('Foto')->storeAs('images', $fileName, 'public');
            $estructura->Foto = '/storage/'.$path;
        };
        $estructura->save();
        return new EstructuraResource($estructura);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function update(EstructuraRequest $request, string $id)
    {
        $estructura = Estructura::find($id);
        $estructura->Nombre = $request->input('Nombre');
        $estructura->Posicion = $request->input('Posicion');
        if ($request->hasFile('Foto')) {
            // Get image actual route
            $currentEstructuraPath = $estructura->Foto;
    
            // Upload new image
            $fileName = time().$request->file('Foto')->getClientOriginalName();
            $path = $request->file('Foto')->storeAs('images', $fileName, 'public');
            $estructura->Foto = '/storage/'.$path;
    
            // Delete old image if exists
            if ($currentEstructuraPath) {
                $this->deleteCompanyEstructura($currentEstructuraPath);
            }
        }
    
        $estructura->save();

        return new EstructuraResource($estructura);
    }
    private function deleteCompanyEstructura($path)
    {
        // Get image route 
        $filePath = public_path($path);

        // Verify file exists and delete
        if (file_exists($filePath)) {
            unlink($filePath);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $estructura = Estructura::find($id);
        $foto = $estructura->Estructura;

        Estructura::destroy($id);

        if ($foto) {
            $foto = public_path($foto); // Get route file
            if (file_exists($foto)) {
                unlink($foto); // Destroy image file
            }
        }


        return response()->json(['success' => 'Deleted Succesfully']);
    }
}
