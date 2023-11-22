@extends('adminlte::page')

@section('title', 'Socio '.$personal->no_socio)

@section('content_header')

@stop

@section('content')
<br>
<div class="card">
    <div class="card-header">
        <h2 ><b>{{ ucwords(strtolower($personal->p_apellido)) }} 
            {{ ucwords(strtolower($personal->s_apellido)) }} {{ ucwords(strtolower($personal->nombre)) }}
        </b></h2>
    </div>
    
    

    <div class="card-body">
      <ul class="nav nav-tabs">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#" data-target="contenido1">Informacion Personal</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="#" data-target="contenido2">Cursos</a>
        </li>
      </ul>
      
      <div id="contenido1" style="display: block;">
        
        <form class="row g-3">
          <div class="col-md-4">
            <label for="p_apellido" class="form-label">Primer Apellido</label></label>
            <input type="text" class="form-control" id="p_apellido" value="{{$personal->p_apellido}}" disabled>
          </div>
          <div class="col-md-4">
            <label for="s_apellido" class="form-label">Segundo Apellido</label>
            <input type="text" class="form-control" id="s_apellido" value="{{$personal->s_apellido}}" disabled>
          </div>
          <div class="col-md-4">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" value="{{$personal->nombre}}" disabled>
          </div>
          <div class="col-12">
            <label for="curp" class="form-label">CURP</label>
            <input type="text" class="form-control" id="curp" value="{{$personal->curp}}" disabled>
          </div>
          <div class="col-4">
            <label for="no_socio" class="form-label">Número de socio</label>
            <input type="number" class="form-control" id="no_socio" value="{{$personal->no_socio}}" disabled>
          </div>
          <div class="col-md-4">
            <label for="fecha_ingreso" class="form-label">Fecha de Ingreso</label>
            <input type="date" class="form-control" id="fecha_ingreso" value="{{$personal->fecha_ingreso}}" disabled>
          </div>

          <div class="col-md-4">
            <label for="Antiguedad" class="form-label">Antiguedad</label>
            <input type="text" class="form-control" id="Antiguedad" 
            value="{{(\Carbon\Carbon::parse($personal->fecha_ingreso))->diffInYears(now())}} años"
            disabled>
          </div>
          <div class="row g-3">
            <div class="col-md-4">
              <label for="tipo_empleado" class="form-label">Tipo de socio</label>
              @if ($personal->tipo_personals == 1)
              <input type="text" class="form-control" id="tipo_empleado" value="Sindicalizado" disabled>    
              @else
              <input type="text" class="form-control" id="tipo_empleado" value="Empleado" disabled>
              @endif
              
            </div>
            <div class="col-md-4">
              <label for="departamento_id" class="form-label">Departamento</label>
              <select id="departamento_id" class="form-select" disabled>
                <option selected value="{{$personal->departamento_id}}">{{$personal->departamento->nombre}}</option>
              </select>
            </div>
            @if (!$personal->departamento->personal )
                
            @else
            <div class="col-md-3">
              <label for="jefe" class="form-label">Jefe</label>
              <input type="text" class="form-control" id="jefe" 
              value="{{ $personal->departamento->personal->p_apellido.' '.$personal->departamento->personal->s_apellido.' '.$personal->departamento->personal->nombre}}">
            </div>
            @endif
          </div>
      </form>
      </div>
      <div id="contenido2" style="display: none;">
        <ul class="list-group">
          @forelse ($personal->cursos as $c)
          <li class="list-group-item">
            {{$c->nombre_curso}}
          </li> 
          @empty
          <li class="list-group-item">
            No ha tomado cursos aún D:
          </li>
          @endforelse
          
        </ul>
      </div>
    </div>
    <div class="card-foot text-muted">
        
    </div>
</div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
    <script>
      document.querySelectorAll('.nav-link').forEach(link => {
        link.addEventListener('click', function(e) {
          e.preventDefault();
          const target = this.getAttribute('data-target');
          document.querySelectorAll('[id^="contenido"]').forEach(contenido => {
            if (contenido.id === target) {
              contenido.style.display = 'block';
            } else {
              contenido.style.display = 'none';
            }
          });
        });
      });
    </script>
@stop