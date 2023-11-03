<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Http\Controllers\Controller;
use App\Models\Asesor;
use App\Models\Curso_categoria;
use Illuminate\Http\Request;
use App\Models\Personal;
use App\Models\Empresa;
use App\Models\Examene;
use App\Models\participante;
use App\Models\TiposAsistencia;

class CursoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $curso_categorias = curso_categoria::all();

        $cursos = Curso::with('asesor')->where('estatus', 1)->get();
        return view('curso.index', compact('cursos', 'curso_categorias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $empresas = Empresa::where('estatus', 1)->get();
        $personals = Personal::where('sindicalizado', 0)->get();
        $curso_categorias = curso_categoria::all();
        $asesores = Asesor::all();
        
    return view('curso.create', compact('asesores', 'curso_categorias', 'personals', 'empresas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $curso = new Curso();
    $curso->nombre_curso = $request->input('nombre_curso');
    $curso->horas_duracion = $request->input('duracion');
    $curso->fecha_inicio = $request->input('fecha_inicio');
    $curso->fecha_fin = $request->input('fecha_fin');
    $curso->curso_categoria_id = $request->input('categoria_id');
    $curso->save();

   

    // Guardar el ID del curso en la sesión para usarlo en el siguiente formulario
    $curso_id= $curso->id;

    if($request->input('examen')=="1"){
        $examen = new Examene();
        $examen -> curso_id =$curso_id;
        $examen->save();

    }

    return redirect()->route('asesor.create', compact('curso_id'));
}



    /**
     * Display the specified resource.
     */
    public function show(curso $curso)
    {
        return view('curso.show', compact('curso'));
    }

    public function cursoParticipantes(curso $curso)
    {
        $participantes = Participante::with(['personal.departamento', 'tipos_asistencia'])->where('curso_id', $curso->id)->get();

        return view('curso.participantes', compact('curso', 'participantes'));
    }

    public function Listas(curso $curso)
    {
        $participantes = Participante::with(['personal.departamento', 'tipos_asistencia'])->where('curso_id', $curso->id)->get();
        $vista='';
        return view('curso.listas', compact('curso', 'participantes', 'vista'));
    }

    public function faltas(curso $curso)
    {
        $participantes = Participante::with(['personal.departamento', 'tipos_asistencia'])->where('curso_id', $curso->id)
        ->where('tipo_asistencia_id', 0)->get();
        $vista='falta';

        return view('curso.listas', compact('curso', 'participantes', 'vista'));
    }
    
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(curso $curso)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, curso $curso)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(curso $curso)
    {
        //
    }

    /*
    Registrar Asistencias
    */

    public function asistencia(curso $curso)
    {
        $participantes = Participante::with(['personal.departamento', 'tipos_asistencia'])
        ->where('tipo_asistencia_id', 0 )->where('curso_id', $curso->id)->get();
        $tipos_asistencia = TiposAsistencia::whereNotIn('id', [0, 1])->get();
        $vista ='asistencia';
        return view('participante.edit', compact('curso', 'participantes', 'tipos_asistencia','vista'));
    }

        /*
    Justificar Faltas
    */

    public function justificar(curso $curso)
    {
        $participantes = Participante::with(['personal.departamento', 'tipos_asistencia'])
        ->where('tipo_asistencia_id', 0 )->where('curso_id', $curso->id)->get();
        $tipos_asistencia = TiposAsistencia::whereNotIn('id', [0, 1])->get();
        $vista ='justificar';
        return view('participante.edit', compact('curso', 'participantes', 'tipos_asistencia','vista'));
    }

}