<?php

namespace App\Http\Controllers;

use App\Models\Pais;
use App\Models\Departamento; 
use App\Models\Municipio; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class PaisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paises = Pais::all();
        return view('paises.index', ["paises"=>$paises]);
        $paises = DB::table('tb_pais')
        ->join('tb_departamento', 'tb_pais.pais_codi', '=', 'tb_departamento.pais_codi')
        ->join('tb_municipio', 'tb_departamento.depa_codi', '=', 'tb_municipio.depa_codi')
        ->select('tb_pais.*', 'tb_departamento.*', 'tb_municipio.*')
        ->get();

    return view('paises.index', ['paises' => $paises]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $paises = DB::table('tb_pais')
        ->orderBy('pais_nomb')
        ->get();
        return view("paises.new", ['paises' => $paises]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $pais = new Pais();
        $pais->pais_nomb = $request->name;
        $pais->pais_codi = $request->code;
        $pais->save();

        return redirect()->route('paises.index')->with('success', 'País creado exitosamente');
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
