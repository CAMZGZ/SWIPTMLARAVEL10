@extends('adminlte::page')

@section('title', 'Crear Curso')

@section('content_header')
    <h1>Crear Curso</h1>
@stop


@section('content')
<form class="row g-3" action="{{ route('curso.store') }}" method="POST">
    @csrf
    <div class="col-md-12">
        <label for="nombre">Nombre del curso:</label>
        <input type="text" name="nombre_curso" id="nombre_curso" class="form-control">
    </div>
    <div class="col-md-4">
            <label for="duracion">Duración (horas) del curso:</label>
            <input type="number" name="duracion" id="duracion" class="form-control">
    </div>
    
    <div class="col-md-4">
        <label for="fecha_inicio">Fecha de inicio:</label>
        <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control">
    </div>
    <div class="col-md-4">
        <label for="fecha_fin">Fecha de fin:</label>
        <input type="date" name="fecha_fin" id="fecha_fin" class="form-control">
    </div>
    
    
    <div class="col-md-4">
        <label for="categoria_id">Categoria</label>
        <select name="categoria_id" id="categoria_id" class="form-control">
            @foreach ($curso_categorias as $ca)
                <option value="{{ $ca->id }}">{{ $ca->categoria }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-4">
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" role="switch" name="examen" value="1">
            <label class="form-check-label" for="flexSwitchCheckDefault">Examen</label>
        </div>  
    </div>

   
    
<div class="text-right mb-2">
    <button type="submit" class="btn btn-primary"><i class="bi bi-floppy"></i></button>
    <button type="submit" class="btn btn-danger" onclick="window.location.href='{{route('curso.index')}}'">
        <i class="bi bi-arrow-90deg-left"></i></button>
</div>
    
</form>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop