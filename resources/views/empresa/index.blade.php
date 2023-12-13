@extends('adminlte::page')

@section('title', 'Empresas')

@section('content_header')
@stop
@section('plugins.Datatables', true)
@section('plugins.Databuttons', true)


@section('content')
<br>

<div class="card">
    <div class="card-header">
        <h2>Empresas</h2>

    </div>
    <div class="card-body">
        <div class="text-right mb-2">
            <a class="btn btn-primary" href="{{route('empresa.create')}}" role="button" onclick=""><i class="bi bi-plus-lg"></i></a>
            <a class="btn btn-warning" href="{{ route('empresa.bajas') }}" role="button" onclick=""> <i class="bi bi-trash-fill"></i></a>
        </div>
        <table id="Empresas" class="table table-striped, align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Razon Social</th> 
                    <th>RFC</th>
                    <th> Opciones</th>
                </tr>    
            </thead>
            <tbody>
                @forelse ($empresas as $e )
                <tr class="align-middle">
                    <td> 
                        <a href="{{route('empresa.show', $e->id)}}" class="text-decoration-none text-reset"> 
                        {{$e->razon_social}}
                    </a>
                </td>
                    <td>  {{$e->rfc}} </td>
                    <td class="align-middle"> 
                    <center>
                        <a class="btn btn-info" 
                        href="{{route('empresa.edit', $e->id)}}" role="button" onclick="">
                        <i class="fas fa-fw fa-pen"></i>
                        </a>
                        
                    </center>
                    </td>
                    
                </tr>    
                @empty
                    <tr>
                        <td colspan="3">
                            Sin datos
                        </td>
                    </tr>
                @endforelse
                
            </tbody>
        </table>
    </div>
</div>
<div id="t_empresas">
    <div class="table-responsive">
    
    

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
            $('#Empresas').DataTable({
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
                        columns: [0, 1] // Columnas a copiar
                    }
                },
                {
                    "extend": "excelHtml5",
                    "text": '<i class="fas fa-fw fa-file-excel"></i>',
                    "className": "btn btn-success",
                    "exportOptions": {
                    "columns": [0, 1] // Columnas a exportar
                    }
                },
                
               
                {
                    "extend": "pdfHtml5",
                    "text": '<i class="fas fa-fw fa-file-pdf"></i>',
                    "className": "btn btn-danger",
                    "exportOptions": {
                    "columns": [0, 1] // Columnas a exportar
                    }
                }
                ]
            });
            });

    </script>
    
@stop