@extends('adminlte::page')

@section('title', 'Todos los Cursos')

@section('content_header')

@stop
@section('plugins.Datatables', true)
@section('plugins.Databuttons', true)


@section('content')
<br>
<div class="card">
    <div class="card-head">
        <p></p>
        <h2 style="text-indent: 0.4cm;"><b>Todos los cursos</b></h2>
    </div>
    
    <div class="card-body">
        <div class="text-right mb-2">
            <a class="btn btn-primary" href="{{route('curso.create')}}" role="button" onclick="">
                <i class="fas fa-fw fa-plus"> </i>
            </a>
            
        </div> 

        <table id="CursosT" class="table table-striped"">
            
            <thead class="table-dark">
                <tr>
                    <th>Nombre</th>
                    <th>Tema</th>
                    <th>Asesor</th>
                    <th>Fecha Inicio</th>
                    <th>Fecha Fin</th>
                    <th> Opciones</th>
                </tr>    
            </thead>
            <tbody>
                @forelse ($cursos as $c )
                <tr class="align-middle">
                    <td> 
                        <a href="{{route('curso.show', $c->id)}}" class="text-decoration-none text-reset"> 
                        {{$c -> nombre_curso}}
                        </a>
                    </td>
                    <td>{{$c->curso_categoria->categoria}}</td>
                    <td>{{$c->asesor-> razon_social}}</td>
                    <td> {{$c->fecha_inicio}} </td>
                    <td> {{$c->fecha_fin}} </td>

                    <td class="text-center">
                        
                        <div style="display: inline-block; margin-top: 0px;">
                            <a class="btn btn-info" 
                            href="{{route('curso.edit', $c->id)}}" role="button" onclick=""
                            data-toggle="tooltip" title="Editar" >
                            <i class="fas fa-fw fa-pen"></i>
                            </a>
                            <a class="btn btn-success" 
                            href="{{route('curso.participantes', $c->id)}}" role="button" onclick=""
                            data-toggle="tooltip" title="Participantes" >
                            <i class="fas fa-fw fa-users"></i>
                            </a>
                            <a class="btn btn-secondary" 
                            href="{{route('curso.listas', $c->id)}}" role="button" onclick=""
                            data-toggle="tooltip" title="Lista Asistencia" >
                            <i class="fas fa-fw fa-clipboard"></i>
                            </a>
                        </div>                       
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
            
</div>
<div id="example-table"></div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    
@stop

@section('js')
    <script> console.log('Hi!'); </script>

    <script>
        $(document).ready(function() {
            $('#CursosT').DataTable({
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
                    className: 'btn btn-warning',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4] // Columnas a copiar
                    }
                },
                {
                    "extend": "excelHtml5",
                    "text": '<i class="fas fa-fw fa-file-excel"></i>',
                    "className": "btn btn-success",
                    "exportOptions": {
                    "columns": [0, 1, 2, 3, 4] // Columnas a exportar
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
                    "columns": [0, 1, 2, 3, 4] // Columnas a exportar
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