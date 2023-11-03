@extends('adminlte::page')

@section('title', 'Registrar Asesor')

@section('content_header')
    <h1>Registrar Asesor</h1>
@stop

@section('content')
<form action="{{ route('asesor.store') }}" method="POST">
    @csrf
    <input type="hidden" name="curso_id" value="{{ $curso_id }}">
    <div class="form-group">
        <label for="tipo">Tipo de asesor:</label>
        <select name="tipo" id="tipo" class="form-control">
            <option value="persona">Persona</option>
            <option value="compania">Compañía</option>
        </select>
    </div>
    <div id="persona-container">
        <div class="form-group">
            <label for="personal_id">Personal:</label>
            <select name="personal_id" id="personal_id" class="form-control">
                @foreach ($personal as $persona)
                    <option value="{{ $persona->id }}"> {{$persona->p_apellido}} {{$persona->s_apellido}} {{ $persona->nombre }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div id="compania-container" style="display: none;">
        <div class="form-group">
            <label for="empresa_id">Empresa:</label>
            <select name="empresa_id" id="empresa_id" class="form-control">
                @foreach ($empresas as $empresa)
                    <option value="{{ $empresa->id }}">{{ $empresa->razon_social }}</option>
                @endforeach
            </select>
        </div>
    </div>
    
    <button type="submit" class="btn btn-primary">Guardar</button>
</form>

@stop

@section('css')

    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script> console.log('Hi!'); </script>
    <script>
        $(document).ready(function() {
    $('#tipo').change(function() {
        if ($(this).val() == 'persona') {
            $('#persona-container').show();
            $('#compania-container').hide();
        } else if ($(this).val() == 'compania') {
            $('#persona-container').hide();
            $('#compania-container').show();
        }
    });
});

    </script>
@stop