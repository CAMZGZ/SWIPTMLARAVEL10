@extends('adminlte::page')

@section('title', 'Crear Curso')

@section('content_header')
    <h1>Crear Curso</h1>
@stop

@section('content')
<form action="{{ route('curso.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="nombre">Nombre del curso:</label>
        <input type="text" name="nombre_curso" id="nombre_curso" class="form-control">
    </div>
    <div class="form-group">
        <label for="duracion">Duración del curso:</label>
        <input type="text" name="duracion" id="duracion" class="form-control">
    </div>
    <div class="form-group">
        <label for="fecha_inicio">Fecha de inicio:</label>
        <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control">
    </div>
    <div class="form-group">
        <label for="fecha_fin">Fecha de fin:</label>
        <input type="date" name="fecha_fin" id="fecha_fin" class="form-control">
    </div>
    
    
    <div class="form-group">
        <label for="categoria_id">Asesor:</label>
        <select name="categoria_id" id="categoria_id" class="form-control">
            @foreach ($curso_categorias as $ca)
                <option value="{{ $ca->id }}">{{ $ca->categoria }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" role="switch" name="examen" value="1">
        <label class="form-check-label" for="flexSwitchCheckDefault">Examen</label>
    </div>
    
<div class="text-right mb-2">
    <button type="submit" class="btn btn-primary"><i class="fas fa-fw fa-floppy-disk"></i>Guardar</button>
    <button type="submit" class="btn btn-danger" onclick="window.location.href='{{route('curso.index')}}'">
        <i class="fas fa-fw fa-floppy-disk-circle-xmark"></i>Cancelar</button>
</div>
    
</form>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop