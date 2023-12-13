@extends('adminlte::page')

@section('title', 'Asesores')

@section('content_header')
    
@stop
@section('plugins.Datatables', true)
@section('plugins.Databuttons', true)

@section('content')
<br>

<div class="card">
    <div class="card-header">
        <h2 ><b>Asesores</b></h2>
    </div>
    <div class="card-body">
        <!--
        <div class="text-right mb-2">
            <a class="btn btn-primary" href="{{route('asesor.create')}}" >
                <i class="fas fa-fw fa-plus">
            </a>
            
            <a class="btn btn-warning" href="{{ route('asesor.bajas') }}">
                <i class="fas fa-fw fa-trash">
                </a>
        </div>
    --> 
        <table id="AsesoresT" class="table table-striped, align-middle">
            
            <thead class="table-dark">
                <tr>
                    <th>Razón Social</th>
                    <th>RFC</th>
                    <th>Cursos Asignados</th>
                    <th> Opciones</th>
                </tr>    
            </thead>
            <tbody>
                @forelse ($asesors as $a )
                <tr class="align-middle">
                    <td> 
                        <a href="{{route('asesor.show', $a->id)}}" class="text-decoration-none text-reset"> 
                        {{$a -> razon_social}}
                    </a>
                </td>
                    <td>
                        @if (!$a->rfc)
                            RFC no disponible
                        @else
                        {{$a->rfc}}    
                        @endif
                        
                    </td>
                    <td>
                        <ul>
                        @forelse ($a->curso as $c)
                        <li>
                            {{$c->nombre_curso}}    
                        </li>  
                        @empty
                            No ha impartido cursos aún
                        @endforelse
                        </ul>
                    </td>
                    
                    <td class="align-middle"> 
                    <center>
                        <a class="btn btn-info" 
                        href="{{route('asesor.edit', $a->id)}}" role="button" onclick="">
                        <i class="fas fa-fw fa-pen"></i>
                        </a>
                        
                    </center>
                    </td>
                    
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

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>

    <script>
        $(document).ready(function() {
            $('#AsesoresT').DataTable({
                "language": {
                "lengthMenu": "Mostrar _MENU_ registros por página",
                "zeroRecords": "No se encontraron Resultados",
                "info": "Página _PAGE_ de _PAGES_",
                "infoEmpty": "No se encontraron datos",
                "infoFiltered": "(Obtenido de _MAX_ total registros)",
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
                    className: 'btn btn-warning',
                    exportOptions: {
                        columns: [0, 1, 2, 3] // Columnas a copiar
                    }
                },
                {
                    "extend": "excelHtml5",
                    "text": '<i class="fas fa-fw fa-file-excel"></i>',
                    "className": "btn btn-success",
                    "exportOptions": {
                    "columns": [0, 1, 2, 3] // Columnas a exportar
                    }
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
                    },
                    "exportOptions": {
                    "columns": [0, 1, 2, 3] // Columnas a exportar
                    }
                }
                ]
            });
            });

    </script>
    
@stop