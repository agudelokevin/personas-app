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
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

       
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
    public function edit($comu_codi)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $comu_codi)
    {
    

    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($comu_codi)
    {
        
    }
}
