@extends('adminlte::page')

@section('title', 'Examenes')

@section('content_header')
@stop
@section('plugins.Datatables', true)
@section('plugins.Databuttons', true)


@section('content')
<div id="t_examen">
    <br>
        <div class="card">
            <div class="card-head">
                <p></p>
                <h2 style="text-indent: 0.4cm;"><b>Examenes</b></h2>
            </div>
            <div class="card-body">
            
                <div class="table-responsive"> 
                <table id="myTable" class="table table-striped, align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Curso</th> 
                            <th>Promedio</th>
                            <th>Contestado</th>
                        </tr>    
                    </thead>
                    <tbody>
                        @forelse ($examenes as $e )
                        <tr class="align-middle">
                            <td> 
                                <a href="{{route('examene.show', $e->id)}}" class="text-decoration-none text-reset"> 
                                    {{$e->curso-> nombre_curso}}
                            </a>
                        </td>
                            <td>{{$e->contestados}}</td>

                            @if ($e->contestados===0)
                                <td> 0 </td>
                            @else
                            <td>{{number_format(($e->total / $e->contestados), 2)}}</td>

                            @endif
                            
                        </tr>    
                        @empty
                        <tr>
                            No data
                        </tr>
                            
                        @endforelse
                        
                    </tbody>
                </table>
            </div>    
        </div>   
    

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
            $('#myTable').DataTable({
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