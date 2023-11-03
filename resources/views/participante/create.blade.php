@extends('adminlte::page')

@section('title', 'Agregar participantes' )

@section('content_header')

@stop
@section('plugins.Datatables', true)


@section('content')
<p></p>
<div class="card">
    <br>
    <div style="text-indent: 0.4cm;" class="card-head">
        <h2><b> {{$curso ->nombre_curso}}</b></h2>
        <h3><b>Añadir Parcipantes</b></h3>
    </div>

    <div  class="card-body text-ellipsis text-right">
        
        <div class="legft" style="display: inline-block; margin-top: 0px;">
            <form id="formulario" method="POST" action="{{ route('participante.agregarSindicalizados') }}" >
                @csrf
                <input type="hidden" name="curso_id" value="{{ $curso_id }}">
                <input type="hidden" name="fecha_limite" value="{{ date('Y-m-15') }}">
                <button type="submit" class="btn btn-outline-warning ml-3">
                    Todos los sindicalizados</button>
            </form>
        </div>

        <div class="right-div" style="display: inline-block; margin-top: 0px;">
            <form id="formulario" method="POST" action="{{ route('participante.agregarEmpledados') }}" >
                @csrf
                <input type="hidden" name="curso_id" value="{{ $curso_id }}">   
                <input type="hidden" name="fecha_limite" value="{{ date('Y-m-15') }}">
                <button type="submit" class="btn btn-outline-success" >
                    Todos los empleados
                </button>
            </form>
        </div>

        
    </div>
    <div class="card-body">
        <form id="formulario" method="POST" action="{{ route('participante.store') }}" >
            @csrf        
            
            <table id="EscogerP" class="table table-striped text-center align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Numero de socio</th>
                        <th class="text-left">Nombre</th>
                        <th>Tipo de Socio</th>
                        <th>Asistencia</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($personal as $persona)
                    
                    <tr>
                        <td> {{$persona->no_socio}} </td>
                        <td class="text-justify">{{$persona->p_apellido}} {{$persona->s_apellido}} {{ $persona->nombre }}</td>
                        @if ($persona->tipo_personals== 1)
                        <td>Sindicalizado</td>
                        @else
                        <td>Empleado</td>
                        @endif
                        <td class="text-center"><input class="form-check-input" type="checkbox" name="personal[]" value="{{ $persona->id }}"></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <input type="hidden" name="curso_id" value="{{ $curso_id }}">
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>
        </div>
    </div>
    

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
    <script>
        $(document).ready(function() {
            $('#EscogerP').DataTable({
                "language": {
                "lengthMenu": "Mostrar _MENU_ registros por página",
                "zeroRecords": "Nothing found - sorry",
                "info": "Página _PAGE_ de _PAGES_",
                "infoEmpty": "No records available",
                "infoFiltered": "(filtered from _MAX_ total records)",
                "search": "Buscar",
                "paginate": {
                    "previous": "Anterior",
                    "next": "Siguiente",
                    "first": "Primero",
                    "last": "Ultimo"
                }
                },
                "autoWidth": false,
                "responsive": true
            });
            });
    </script>
@stop