@extends('adminlte::page')

@section('title', 'Departamentos')

@section('content_header')
@stop
@section('plugins.Datatables', true)

@section('content')
<div class="card">
    <div class="card-header">
        <h2>Departamentos</h2>
    </div>
    <div class="card-body">
        <div class="text-right mb-2">
            <a class="btn btn-primary" href="{{route('departamento.create')}}" role="button" onclick=""><i class="bi bi-plus-lg"></i></a>
            <a class="btn btn-warning"  role="button" onclick=""> <i class="bi bi-trash-fill"></i></a>
        </div>
        <table id="myTable" class="table table-striped, align-middle">
            <thead class="table-dark">
                <tr>
                    <th>CECO</th> 
                    <th>Departamento</th>
                    <th>Empresa</th>
                    <th> Opciones</th>
                </tr>    
            </thead>
            <tbody>
                @forelse ($departamentos as $d )
                <tr class="align-middle">
                    <td> 
                        <a href="{{route('departamento.show', $d->id)}}" class="text-dark"> 
                        {{$d -> ceco}}
                    </a>
                </td>
                    <td>  {{$d->nombre}} </td>
                    <td>{{$d->empresa-> razon_social}}</td>
                    <td class="align-middle"> 
                    <center>
                        <a class="btn btn-info" 
                        href="{{route('departamento.edit', $d->id)}}" role="button" onclick="">
                        <i class="fas fa-fw fa-pen"></i>
                        </a>
                        
                    </center>
                    </td>
                    
                </tr>    
                @empty
                    <p> No data</p>
                @endforelse
                
            </tbody>
        </table>
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
            $('#myTable').DataTable({
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