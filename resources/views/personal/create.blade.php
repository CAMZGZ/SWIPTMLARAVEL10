@extends('adminlte::page')

@section('title', 'Registrar Socio')

@section('content_header')

@stop

@section('content')
<br>
<div class="card">
    <div class="card-header">
        <h2 ><b>
          Registrar Socio
        </b></h2>
    </div>
    <div class="card-body">
        
        <form class="row g-3">
          <div class="col-md-4">
            <label for="p_apellido" class="form-label">Primer Apellido</label></label>
            <input type="text" class="form-control" id="p_apellido" >
          </div>
          <div class="col-md-4">
            <label for="s_apellido" class="form-label">Segundo Apellido</label>
            <input type="text" class="form-control" id="s_apellido" >
          </div>
          <div class="col-md-4">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" >
          </div>
          <div class="col-12">
            <label for="curp" class="form-label">CURP</label>
            <input type="text" class="form-control" id="curp" >
          </div>
          <div class="col-4">
            <label for="no_socio" class="form-label">Número de socio</label>
            <input type="number" class="form-control" id="no_socio" >
          </div>
          <div class="col-md-4">
            <label for="fecha_ingreso" class="form-label">Fecha de Ingreso</label>
            <input type="date" class="form-control" id="fecha_ingreso" >
          </div>


          <div class="row g-3">
            <div class="col-md-4">
              <label for="departamento_id" class="form-label">Empleado</label>
              
              <select name="departamento_id" id="departamento_id" class="form-select">

                <option selected value="1">Sindicalizado</option>
                <option selected value="1">Empleado</option>
              </select>
            </div>
            <div class="col-md-4">

              <label for="departamento_id" class="form-label">Departamento</label>
              <select id="departamento_id" class="form-select">

              @forelse ($departamentos as $d)
                <option selected value="{{$d->id}}">{{$d->nombre}}</option>
              @empty

              @endforelse
              </select>
            </div>
            <div class="text-right mb-6">
              <button class="btn btn-primary" type="submit"><i class="bi bi-floppy"></i></button>
              <a href="{{route('personal.index')}}" class="btn btn-danger"><i class="bi bi-arrow-90deg-left"></i></a>
            </div>

        </form>
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

@stop