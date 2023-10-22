<?php

namespace App\Http\Controllers;

use App\Models\Comuna;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ComunaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $comunas = Comuna::all();
        return view("comunas.index", ["comunas" => $comunas]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $municipios = DB::table('tb_municipio')->orderBy('muni_nomb')->get();
        //$departamentos = DB::table('tb_departamento')->orderBy('depa_nomb')->get();
        //$paises = DB::table('tb_pais')->orderBy('pais_nomb')->get();

        return view('comunas.new', [
            'municipios' => $municipios,
            //'departamentos' => $departamentos,
           // 'paises' => $paises,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $comuna = new Comuna();
        $comuna->comu_nomb = $request->name;
        $comuna->muni_codi = $request->code;
        $comuna->save();

        return redirect()->route('comunas.index') ;
       
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $comuna = Comuna::find($id);
        $municipios = DB::table('tb_municipio')
        ->orderBy('muni_nomb')
        ->get(); 
        return view('comunas.edit', ['comuna' => $comuna, 'municipios' => $municipios]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $comuna = Comuna::find($id);

        $comuna->comu_nomb = $request->name;
        $comuna->muni_codi = $request->code;
        $comuna->save();


        return redirect()->route('comunas.index') ;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $comuna = Comuna::find($id);

        if (!$comuna) {
            return redirect()->route('comunas.index')->with('error', 'La comuna no existe.');
        }

        $comuna->delete();

        return redirect()->route('comunas.index')->with('success', 'Comuna eliminada exitosamente.');
    }
}
