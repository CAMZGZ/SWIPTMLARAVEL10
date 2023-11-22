<?php

namespace App\Livewire;

use App\Models\Calificacion;
use App\Models\Curso;
use App\Models\departamento;
use App\Models\Examene;
use App\Models\Participante;
use App\Models\personal;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Examenes extends Component
{
    private string $curp;

    public $busqueda;
    public $buscando = false;
    public $examene;
    public $curso = "";
    public $participantes = "";
    public $resultados;
    public $fecha;
    public $newfecha;
    public $cu = "";
    public $seleccionados =[];
    public $calif;
    
    use WithPagination;


    protected $listeners = ['clearSearch'];
    protected $rules = [
        'newfecha' => 'required',
        'busqueda' => 'required',
    ];
    protected $messages = [
        'required' => 'Campo Obligatorio.',
    ];


    
    public function render()
    {
        $this->curso = Curso::where('id', $this->examene->curso_id)->first();
        
        $this->participantes = Calificacion::with(['personal.departamento', 'personal.participante' => function ($query) {
            $query->where('curso_id', '=', $this->curso->id);
        }])
        ->where('examen_id', $this->examene->id)
        ->get();
        $cuenta = Calificacion::where('examen_id', $this->examene->id)
        ->selectRaw('COUNT(*) as total_registros, SUM(calificacion) as suma_calificaciones')
        ->first();

        if (!$this->buscando) {

        }
        else {
            

            $this->resultados = DB::table('personals')
            ->join('participantes', 'personals.id', '=', 'participantes.personal_id')
            ->join('cursos', 'participantes.curso_id', '=', 'cursos.id')
            ->where('cursos.id', '=', $this->examene->curso_id)
            ->where(function ($query) {
                $query->whereRaw("concat( personals.p_apellido, ' ', personals.s_apellido, ' ', personals.nombre) like '%{$this->busqueda}%'")
                    ->orWhereRaw("concat(personals.nombre, ' ',  personals.p_apellido, ' ', personals.s_apellido) like '%{$this->busqueda}%'")
                    ->orWhere('personals.nombre', 'like', '%' . $this->busqueda . '%')
                    ->orWhere('personals.p_apellido', 'like', '%' . $this->busqueda . '%')
                    ->orWhere('personals.s_apellido', 'like', '%' . $this->busqueda . '%')
                    ->orWhere('personals.no_socio', 'like', '%' . $this->busqueda . '%');
            })
            ->take(1)
            ->get();
            $this->fecha;
        }



        return view('livewire.examenes', compact('cuenta'));
    }

    public function toggleSearching()
    {
        $this->validate();

        $this->buscando = !$this->buscando;
        $this->fecha = $this->newfecha;

    }


    public function calificar($curp)
    {
        $persona = Personal::with('departamento')->where('curp', $curp)->first();
        $this->curso = Curso::where('id', $this->examene->curso_id)->first();

        if ($persona) {

            $calificacion = Calificacion::where('personal_id', $persona->id)->where('examen_id', $this->examene->id)->first();
            if ($calificacion) {
                $calificacion->calificacion = $this->calif;
                $calificacion->save();
            }
            else{
                $participante = Participante::where('personal_id', $persona->id)->where('curso_id', $this->curso->id)->first();
                $participante->tipo_asistencia_id = '1';
                $participante->fecha_asistencia= $this->fecha;
                $participante->save();
                
                $calificacion = Calificacion::create([
                    'examen_id' => $this->examene->id,
                    'personal_id' => $persona->id,
                    'calificacion' => $this->calif,
                ]);
        
                if ($calificacion) {
                    // El registro de calificación se creó correctamente
                    return back()->with('success', 'Mensaje de éxito');
                    } else {
                    // Error al crear el registro de calificación
                    return back()->with('fail', 'Mensaje de Falla');
                }
            }

        } else {
            // La persona no fue encontrada
            return back()->with('success', 'No fue encontrado');
            
        }
        $this->reset(['calif']); // Limpiar el valor de calificacion después de agregarlo

    }
    

    
    public function tablar($curp)
    {
        $persona = Personal::with('departamento')->where('curp', $curp)->first();
    
        // Agregar validación para evitar duplicados
        if (!in_array($persona->id, array_column($this->seleccionados, 'id'))) {
            $this->seleccionados[] = [
                'curp' => $persona->curp,
                'no_socio' => $persona->no_socio,
                'departamento' =>$persona->departamento->nombre,
                'nombre_completo' => $persona->p_apellido . ' ' . $persona->s_apellido . ' ' . $persona->nombre,
                'calificacion' => '', // Puedes establecer una calificación por defecto o dejarlo en blanco
            ];
        }
    
    }


}
