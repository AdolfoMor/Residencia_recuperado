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
         $afiliados = Afiliado::with("direcciones")->get(); 
        //$afiliados = Afiliado ::get(); 
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
        if($request->hasFile('Logo')){
            $fileName = time().$request->file('Logo')->getClientOriginalName();
            $path = $request->file('Logo')->storeAs('images', $fileName, 'public');
            $afiliado->Logo = '/storage/'.$path;
        };
        $afiliado->save();
        return new AfiliadoResource($afiliado);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Afiliado  $afiliado
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $term )
    { 
        $variable = Afiliado::where('Nombre', '=', '%'.$term.'%')->with("direcciones")->get();
        return AfiliadoResource::collection($variable);
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
        $afiliado->Nombre = $request->input('Nombre');
        $afiliado->RFC = $request->input('RFC');
        $afiliado->Descripción = $request->input('Descripción');
        if ($request->hasFile('Logo')) {
            // Get image actual route
            $currentLogoPath = $afiliado->Logo;
    
            // Upload new image
            $fileName = time().$request->file('Logo')->getClientOriginalName();
            $path = $request->file('Logo')->storeAs('images', $fileName, 'public');
            $afiliado->Logo = '/storage/'.$path;
    
            // Delete old image if exists
            if ($currentLogoPath) {
                $this->deleteCompanyLogo($currentLogoPath);
            }
        }
    
        $afiliado->save();

        return new AfiliadoResource($afiliado);
    }
    private function deleteCompanyLogo($path)
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
     * @param  \App\Models\Afiliado  $afiliado
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $id)
    {
        $afiliado = Afiliado::find($id);
        $logo = $afiliado->Logo;

        Afiliado::destroy($id);

        if ($logo) {
            $logo = public_path($logo); // Get route file
            if (file_exists($logo)) {
                unlink($logo); // Destroy image file
            }
        }


        return response()->json(['success' => 'Deleted Succesfully']);
    }
}
