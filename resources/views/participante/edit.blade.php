@extends('adminlte::page')

@section('title', 'Registar asistencia' )

@section('content_header')

@stop
@section('plugins.Datatables', true)


@section('content')
<p></p>
<div class="card">
    <br>
    <div style="text-indent: 0.4cm;" class="card-header">
        <h2><b> {{$curso ->nombre_curso}}
        <h3>
            @if ($vista ==="asistencia")
                Registrar Asistencia
            @elseif ($vista ==='justificar')
                Justificar faltas
            @endif
            </h3>
        </b></h2>
    </div>
    <form id="formulario" method="POST" action="{{ route('participante.update', $curso->id) }}" >
        @method('PUT')

        @csrf
        <div class="card-body">
            <input type="hidden" name="vista" value="{{ $vista}}">
            <div  class=" form-group text-center row g-4">
            @if ($vista === 'asistencia')
                <div class="col-auto">
                    <label for="fecha">Fecha:</label>
                </div>    
                <div class="col-auto">
                    <input type="date" name="fecha" id="fecha" class="form-control">
                </div>
            @endif
                <div class="col-auto text-ellipsis text-right">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
        </div>         
                <table id="Lista" class="table table-striped table-sm text-center align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Número de socio</th>
                            <th class="text-left">Nombre</th>
                            <th> Departamento</th>
                            <th>Tipo de Socio</th>
                            <th>
                                @if ($vista ==='asistencia')
                                Asistencia    
                                @elseif ($vista ==='justificar')
                                Justificación
                                @endif
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($participantes as $p)
                        
                        <tr>
                            <td> {{$p->personal->no_socio}} </td>
                            <td class="text-justify">
                                {{$p->personal->p_apellido}} {{$p->personal->s_apellido}} {{ $p->personal->nombre }}</td>
                            <td>{{$p->personal->departamento->nombre}}</td>
                            @if ($p->personal->tipo_personals== 1)
                            <td>Sindicalizado</td>
                            @else
                            <td>Empleado</td>
                            @endif
                            <td class="text-center">
                                @if ($vista ==='asistencia')
                                <input type="hidden" name="tipo_asistencia_id" value="1">
                                <input class="form-check-input" type="checkbox" name="participante[]" value="{{ $p->id }}">
                                @elseif ($vista ==='justificar')
                                <div class="form-group">
                                    <select name="tipo_asistencia_id" id="tipo_asistencia_id" class="form-control form-select-sm">
                                        <option value= "0" >Justificación</option></option>
                                        @foreach ($tipos_asistencia as $ta)
                                            <option value="{{ $ta->id }}"> {{$ta->tipo_asistencia}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <input type="hidden" name="participante[]" value="{{ $p->id }}">    
                                @endif
                                
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <input type="hidden" name="curso_id" value="{{ $curso->id }}">
                
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
            $('#Lista').DataTable({
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
                "responsive": true,
                "paging": false,
                "stateSave": true,
                "stateSaveCallback": function (state, data) {
                    // Mantenga las casillas de verificación seleccionadas
                    data.selectedRows = $('input[name^="participante[]"]:checked').map(function() {
                        return $(this).val();
                    }).get();
                    data.selectedOption = $('#tipo_asistencia_id').val();
                    return state;
                },
                "stateLoadCallback": function (state, data) {
                    // Restaure las casillas de verificación seleccionadas
                    var selectedRows = data.selectedRows || [];
                    $('input[name^="participante[]"]').each(function() {
                        var value = $(this).val();
                        if (selectedRows.indexOf(value) !== -1) {
                            $(this).prop('checked', true);
                        }
                    });
                    // Restaure la opción seleccionada
                    var selectedOption = data.selectedOption || "";
                    $('#tipo_asistencia_id').val(selectedOption);
                    return state;
                }
            });
        });

    </script>
@stop