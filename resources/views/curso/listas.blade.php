@extends('adminlte::page')
@if ($vista==='falta')
@section('title', 'Faltas: '.$curso->nombre_curso)
@else
@section('title', 'Lista Asistencia: '.$curso->nombre_curso)
@endif


@section('content_header')
@stop

@section('plugins.Sweetalert2', true)

@section('content')
<div class="card">
    <div class="card-head">
        <br>
        <h2 style="text-indent: 0.4cm;"><b>{{$curso->nombre_curso}}</b></h2>
    </div>

    @if ($vista==='falta')
        
    @else
    <div class="card-body text-ellipsis text-right">
        <div style="display: inline-block; margin-top: 0px;">
            <button class="btn btn-secondary" type="submit" role="button"
            data-toggle="tooltip" title="Justificar Faltas" 
            onclick="window.location.href='{{route('curso.justificar', $curso->id)}}'"> 
                <i class="fas fa-fw fa-user-clock"></i>
            </button>
        </div>
        <div style="display: inline-block; margin-top: 0px;">
            
                <button class="btn btn-success" type="submit" role="button"
                data-toggle="tooltip" title="Registrar Asistencia" 
                onclick="window.location.href='{{route('curso.asistencia', $curso->id)}}'"> 
                    <i class="fas fa-fw fa-user-check"></i></button>
            
        </div>
        <div style="display: inline-block; margin-top: 0px;">
            <button class="btn btn-danger" type="submit" role="button"
                data-toggle="tooltip" title="Lista de faltas" 
                onclick="window.location.href='{{route('curso.faltas', $curso->id)}}'">
                    <i class="fas fa-fw fa-user-slash"></i></button>
        </div>
    </div> 
    @endif
        

    <div class="card-body">
        <table id="LAsistencia" class="table table-striped table-bordered table-sm">
            @if ($vista==='falta')

            <thead class="table-danger">

            @else
            <thead class="table-dark">
            @endif
                <tr class="text-center">
                    <th scope="col">Número de socio</th>
                    <th>Nombre</th>
                    @if ($vista==='falta')
                    <th class="text-center">CECO</th>
                    <th class="text-center">DEPARTAMENTO</th>  
                    @else
                    <th class="text-center">Asistencia</th>
                    <th class="text-center">Fecha Asistencia</th>      
                    @endif
        
                </tr>    
            </thead>
            <tbody>
                @forelse ($participantes as $p )
                <tr class="text-justify">
                    <td> {{$p-> personal -> no_socio}}</td>
                    
                    <td> 
                        {{$p -> personal -> p_apellido}} {{$p -> personal -> s_apellido}} {{$p -> personal -> nombre}}
                        
                    </td>
                    @if ($vista==='falta')
                        <td> {{$p->personal->departamento->ceco }}</td>
                        <td> {{$p->personal->departamento->nombre }}</td>
                    @else
                    <td class="text-center">
                        @if ($p->tipos_asistencia->id == 0)
                        <i class="bi bi-x-circle-fill"></i> {{$p->tipos_asistencia->tipo_asistencia }} 
                        
                        @elseif ($p->tipo_asistencia_id == 1)
                        <i class="bi bi-check2-circle"></i> {{$p->tipos_asistencia->tipo_asistencia }}
    
                        @elseif ($p->tipo_asistencia_id == 2)
                        <i class="fas fa-fw fa-tired"></i> {{$p->tipos_asistencia->tipo_asistencia }}
    
                        @else
                        <i class="fas fa-fw fa-sun"></i> {{$p->tipos_asistencia->tipo_asistencia }}
                        </td>
    
    
                        @endif
    
                        <td class="text-center"> {{$p->fecha_asistencia}} </td>
    
                    @endif
                                        
                </tr>    
                @empty
                <tr>
                    <td colspan="3" style="text-align: center; font-size: 24px;">Sin datos</td>
                </tr>
                    
                @endforelse
                
            </tbody>
        </table>
    </div>
</div>

<div class="text-right mb-2">

    <a class="btn btn-warning" 
    href="{{ $vista === 'falta' ? route('curso.listas', $curso->id) : route('curso.index') }}" 
    role="button" onclick=""><i class="fas fa-fw fa-arrow-left"></i></a>

</div>





@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
    
    <script>
        $(document).ready(function() {
            $('#LAsistencia').DataTable({
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
                "dom": "Bfrtip",
                "buttons": [
                    {
                    extend: 'copyHtml5',
                    text: '<i class="fas fa-fw fa-copy"></i>',
                    className: 'btn btn-warning'
                },
                {
                    "extend": "excelHtml5",
                    "text": '<i class="fas fa-fw fa-file-excel"></i>',
                    "className": "btn btn-success"
                },
                
                {
                    "extend": "pdfHtml5",
                    "text": '<i class="fas fa-fw fa-file-pdf"></i>',
                    "className": "btn btn-danger",
                    "customize": function(doc) {
                    // Estilos CSS para el PDF
                    var table = doc.content[1].table;
                    var rowLength = table.body[0].length;
                    for (var i = 0; i < rowLength; i++) {
                        table.body[0][i].fillColor = '#007bff'; // Color de encabezados
                        table.body[0][i].color = '#fff'; // Color de texto de encabezados
                    }
                    }
                }
                ]
            });
            });

    </script>
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
@stop