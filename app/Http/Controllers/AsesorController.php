<?php

namespace App\Http\Controllers;

use App\Models\Asesor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Empresa;
use App\Models\Personal;
use App\Models\Curso;

class AsesorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $asesors = Asesor::where('estatus', 1)->get();
        return view('asesor.index', compact('asesors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        //
        $curso_id = $request->input('curso_id');


        $empresas = Empresa::where('estatus', 1)->get();
        $personal = Personal::where('tipo_personals', 0)->get();
        return view('asesor.create', compact( 'personal', 'empresas', 'curso_id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        $curso_id = $request->input('curso_id');
        if ($request->input('tipo') == 'persona') {
            $comprobar = Asesor::where('personal_id', $request->input('personal_id'))->first();
        } else if ($request->input('tipo') == 'compania'){
            $comprobar = Asesor::where('empresa_id', $request->input('empresa_id'))->first();

        }

        if(!$comprobar) {
            $asesor = new Asesor();
            if ($request->input('tipo') == 'persona') {
                $personal = Personal::find($request->input('personal_id'));
                $asesor->razon_social = $personal->p_apellido . ' ' . $personal->s_apellido . ' ' . $personal->nombre;
                $asesor->personal_id = $personal->id;
                $asesor->empresa_id = null;
                $asesor -> rfc =null;
                $asesor->save();
            } else if ($request->input('tipo') == 'compania') {
                $empresa = Empresa::find($request->input('empresa_id'));
                $asesor->razon_social = $empresa->razon_social;
                $asesor->personal_id = null;
                $asesor->empresa_id = $empresa->id;
                $asesor->rfc = $empresa->rfc;
                $asesor->save();
            } 
        }
        
        
        if ($request->input('tipo') == 'persona') {
            // Guardar el ID del asesor en la tabla cursos
                $asesorr = Asesor::where('personal_id', $request->input('personal_id'))->first();
                $curso = Curso::find($curso_id);
                $curso->update(['asesor_id' => $asesorr->id]);
        }else if ($request->input('tipo') == 'compania'){
            $asesorr = Asesor::where('empresa_id', $request->input('empresa_id'))->first();
            $curso = Curso::find($curso_id);
            $curso->update(['asesor_id' => $asesorr->id]);
        }
        
            return redirect()->route('curso.index');
    }

   

    /**
     * Display the specified resource.
     */
    public function show(asesor $asesor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(asesor $asesor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, asesor $asesor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(asesor $asesor)
    {
        //
    }

    
    
}
