<?php
namespace App\Http\Controllers;
use App\Models\Comuna;
use App\Models\Pais;
use App\Models\Departamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class ComunaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$comunas = Comuna::all();
        $comunas = DB::table('tb_comuna')
            ->join('tb_municipio', 'tb_comuna.muni_codi', '=', 'tb_municipio.muni_codi')
            ->join('tb_departamento', 'tb_municipio.depa_codi', '=', 'tb_departamento.depa_codi')
            ->select('tb_comuna.*', 'tb_municipio.muni_nomb')
            ->get();
        return view("comunas.index", ["comunas" => $comunas]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $municipios = DB::table('tb_municipio')->orderBy('muni_nomb')->get();
        $departamentos = DB::table('tb_departamento')->orderBy('depa_nomb')->get();
        $paises = DB::table('tb_pais')->orderBy('pais_nomb')->get();
    
        return view('comunas.new', [
            'municipios' => $municipios,
            'departamentos' => $departamentos,
            'paises' => $paises,
        ]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $comuna = new Comuna();
        $comuna->comu_nomb = $request->name;
        $comuna->muni_codi = $request->code;
        $comuna->save();


        // Obtén nuevamente la lista actualizada de municipios
        $municipios = DB::table('tb_municipio')
            ->orderBy('muni_nomb')
            ->get();

        $comunas = DB::table('tb_comuna')
            ->join('tb_municipio', 'tb_comuna.muni_codi', '=', 'tb_municipio.muni_codi')
            ->select('tb_comuna.*', 'tb_municipio.muni_nomb')
            ->get();
        return view('comunas.index', ['comunas' => $comunas]);

        return view('comunas.index', ['comunas' => $comunas, 'municipios' => $municipios]);
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
        $comuna = Comuna::find($id);
        $municipios = DB::table('tb_municipio')->orderBy('muni_nomb')->get();
        $departamentos = DB::table('tb_departamento')->orderBy('depa_nomb')->get();
        $paises = DB::table('tb_pais')->orderBy('pais_nomb')->get(); // Obtener los países

    return view('comunas.edit', [
        'comuna' => $comuna,
        'municipios' => $municipios,
        'departamentos' => $departamentos,
        'paises' => $paises, // Pasar los países a la vista
    ]);
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
        $comuna = Comuna::find($id);
        
        $comuna->comu_nomb = $request->name;
        $comuna->muni_codi = $request->code;
        $comuna->save();
    
        $comunas = DB::table('tb_comuna')
            ->join('tb_municipio', 'tb_comuna.muni_codi', '=', 'tb_municipio.muni_codi')
            ->select('tb_comuna.*', 'tb_municipio.muni_nomb')
            ->get();
        return view('comunas.index', ['comunas' => $comunas]); 
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comuna = Comuna::find($id);
        $comuna -> delete();
        $comunas = DB::table('tb_comuna')
        ->join('tb_municipio' , 'tb_comuna.muni_codi', '= ','tb_municipio.muni_  codi') 
        ->select('tb_comuna.*', "tb_municipio.muni_nombe")
        ->get();
        return  view ('comunas.index' ,['comunas'=> $comunas]);
    }
}