<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\participante;
use App\Models\personal;
use Illuminate\Http\Request;
use App\Models\curso;

class ParticipanteController extends Controller
{

    
    //
        /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        //
        $curso_id = $request->input('curso_id');
        $curso = Curso::where('id', $curso_id)->first();

        $personal = Personal::where('estatus', 1)
        ->whereNotIn('id', function ($query) use ($curso_id) {
            $query->select('personal_id')
                ->from('participantes')
                ->where('curso_id', $curso_id);
        })
        ->get();
        
        return view('participante.create', compact( 'personal', 'curso_id', 'curso'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $curso_id = $request->input('curso_id');
        $personal_ids = $request->input('personal');

        $participantes = [];
        foreach ($personal_ids as $personal_id) {
            $participante = new Participante;
            $participante->curso_id = $curso_id;
            $participante->personal_id = $personal_id;
            $participante->save();
            $participantes[] = $participante;
        }

        return redirect()->route('curso.show', $curso_id);
    }

    public function agregarSindicalizados(Request $request)
    {
        $curso_id = $request->input('curso_id');
        $fecha_limite = $request->input('fecha_limite');
        $personal = Personal::where('tipo_personals', 1)
            ->where('fecha_ingreso', '<', $fecha_limite)
            ->get();
        $participantes = [];
        foreach ($personal as $person) {
            $participante = Participante::where('curso_id', $curso_id)
                ->where('personal_id', $person->id)
                ->first();
            if (!$participante) {
                $participante = new Participante;
                $participante->curso_id = $curso_id;
                $participante->personal_id = $person->id;
                $participante->save();
                $participantes[] = $participante;
            }
        }
        return redirect()->route('curso.show', $curso_id);
    }

    public function agregarEmpledados (Request $request)
    {
        $curso_id = $request->input('curso_id');
        $fecha_limite = $request->input('fecha_limite');

        $personal = Personal::where('tipo_personals', 0)
            ->where('fecha_ingreso', '<', $fecha_limite)
            ->get();
        $participantes = [];
        foreach ($personal as $person) {
            $participante = Participante::where('curso_id', $curso_id)
                ->where('personal_id', $person->id)
                ->first();
            if (!$participante) {
                $participante = new Participante;
                $participante->curso_id = $curso_id;
                $participante->personal_id = $person->id;
                $participante->save();
                $participantes[] = $participante;
            }
        }

        
        return redirect()->route('curso.show', $curso_id);
    }

    public function delete (Request $request)
    {
        
    }

    public function update (Request $request, curso $curso){
        $curso_id = $request->input('curso_id');
        $participantes_ids = $request->input('participante');
        $participantes = [];
        foreach ($participantes_ids as $participante_id) {
            $participante = Participante::find($participante_id);
            $participante->tipo_asistencia_id = $request->input('tipo_asistencia_id');
            if($request->input('vista') == 'asistencia'){
                $participante->fecha_asistencia = $request->input('fecha');
            }
            $participante->save();
            $participantes[] = $participante;
        }
        $curso=Curso::find($curso_id);

        $participantes = Participante::with(['personal.departamento', 'tipos_asistencia'])->where('curso_id', $curso->id)->get();
        return view('curso.listas', compact('curso', 'participantes'));

    }



}
