@extends('adminlte::page')

@section('title', $curso->nombre_curso)


@section('content_header')
@stop

@section('plugins.Datatables', true)

@section('content')
<div class="card">
  <div class="card-head">
    <br>
    <h2 style="text-indent: 0.4cm;"><b>        {{$curso->nombre_curso}}        </b></h2>

  </div>
  <div class="card-body">
    <div class="row">
      <div class="col-sm-6 mb-3 mb-sm-0">
        <div class="card">
          <div class="card-body text-capitalize text-center">
            <h5 class="card-title">
                Nombre
            </h5>
            <p class="card-text">
            {{$curso->nombre_curso}}    
        </p>
          </div>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="card">
          <div class="card-body text-capitalize text-center">
            <h5 class="card-title">
                Fecha
            </h5>
            <p class="card-text">
            {{$curso->fecha_inicio}}
            </p>
            
          </div>
          
        </div>
      </div>
    </div>
  </div>
</div>


<div class="text-right mb-2">

    <a class="btn btn-info" href="{{route('curso.edit', $curso->id)}}" role="button" onclick="">Editar</a>
    <a class="btn btn-warning" 
    href="{{ $curso->estatus == 1 ? route('curso.index') : route('curso.index') }}" 
    role="button" onclick="">Regresar</a>

</div>

<div class="text-center mb-7">

  <form method="GET" action="{{ route('participante.create') }}">
    @csrf
    <input type="hidden" name="curso_id" value="{{ $curso->id }}">
    <button id="reactivate" class="btn btn-success" type="submit" role="button">Agregar Participantes</button>
</form>
</div>



@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop