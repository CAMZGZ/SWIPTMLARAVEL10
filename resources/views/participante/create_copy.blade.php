@extends('adminlte::page')

@section('title', 'Agregar participantes')

@section('content_header')

    <h1>Agregar Participantes</h1>
@stop

@section('content')
<form action="{{route('participantes.store')}}" method="POST">
    @csrf
    <input type="hidden" name="curso_id" value="{{ $curso_id }}">

    <div class="form-group">
        <label for="participantes[0][personal_id]">Socio:</label>
        <select name="participantes[0[personal_id]]" id="personal_id" 
        name="personal_id" class="formc-control">
        @foreach ($personal as $p )
        <option value="{{$p->id}}">{{$p->p_apellido}} {{$p-s_apellido}} {{$p->nombre}}
        </option>

            
        @endforeach
        </select>
    </div>
    <div id="participantes-container" class="text-right">
        <button type="button" class="btn btn-primary" id="agregar-participante">
            <i class="fas fa-fw fa-plus"> </i>
        </button>
    </div>

</form>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
    <script>
        $(document).ready(function() {
    var participanteIndex = 0;
    $('#agregar-participante').click(function() {
        participanteIndex++;
        var participanteHtml = `
            <div class="form-group">
                <label for="participantes[${participanteIndex}][empresa_id]">Empresa:</label>
                <select name="participantes[${participanteIndex}][empresa_id]" id="empresa_id" class="form-control">
                    @foreach ($empresas as $empresa)
                        <option value="{{ $empresa->id }}">{{ $empresa->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="participantes[${participanteIndex}][personal_id]">Personal:</label>
                <select name="participantes[${participanteIndex}][personal_id]" id="personal_id" class="form-control">
                    @foreach ($personal as $persona)
                        <option value="{{ $persona->id }}">{{ $persona->nombre }}</option>
                    @endforeach
                </select>
            </div>
        `;
        $('#participantes-container').append(participanteHtml);
    });
});

    </script>
@stop