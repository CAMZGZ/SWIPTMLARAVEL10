<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\curso;
use App\Models\departamento;
use App\Models\personal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WelcomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $curso=curso::where('id', '9a6ac748-3e9b-4116-a367-68368f222218')->first();

        $participantes = DB::table('participantes')
        ->join('personals', 'personals.id', '=', 'participantes.personal_id')
        ->join('departamentos', 'departamentos.id', '=', 'personals.departamento_id')
        ->select('departamentos.nombre')
        ->selectRaw('COUNT(*) as nparticipantes')
        ->selectRaw('COUNT(CASE WHEN participantes.tipo_asistencia_id = 0 THEN 1 ELSE NULL END) as participantesf')
        ->selectRaw('COUNT(CASE WHEN participantes.tipo_asistencia_id <> 0 THEN 1 ELSE NULL END) as participantesa')
        ->selectRaw('MAX(departamentos.ceco) as ceco')
        ->groupBy( 'departamentos.nombre' )
        ->where('participantes.curso_id', $curso->id)
        ->where('personals.tipo_personals', '1')
        ->get();

        $departamentos = [];

        foreach ($participantes as $p){
            $d=departamento::where('ceco', $p->ceco)->first();
            $j =personal::where('id', $d->personal_id)->first();
            $departamentos[] = [
                'ceco' => $p->ceco,
                'area' => $p->nombre,
                'nparticipantes' => $p->nparticipantes,
                'participantesa' => $p->participantesa,
                'participantesf' => $p->participantesf,
                'porcentaje' => number_format(($p->participantesa / $p->nparticipantes)*100, 2), 
                'jefe' => $j->p_apellido.' '.$j->s_apellido.' '.$j->nombre,
            ];
        }

        return view('welcome', compact('curso', 'participantes','departamentos'));
    }
}