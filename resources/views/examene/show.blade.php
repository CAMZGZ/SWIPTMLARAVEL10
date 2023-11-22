@extends('adminlte::page')

@section('title', 'Examen: '.$curso->nombre_curso)

@section('content_header')

@stop
@section('plugins.Datatables', true)
@section('plugins.Databuttons', true)
@section('plugins.Select2', true)


@section('content')
<br>

    @livewire('examenes', ['examene'=>$examene, key($examene)])

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@livewireScripts()

@section('js')
    <script>
        $(document).ready(function() {
        $('.select2').select2({
            placeholder: 'Selecciona una opción',
            allowClear: true,
            minimumInputLength: 3,
            ajax: {
            url: '/mi-ruta',
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                q: params.term
                };
            },
            processResults: function (data) {
                return {
                results: data
                };
            },
            cache: true
            }
        });
        });
    </script>

<script>
    $(document).ready(function() {
        $('#participantess').DataTable({
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
                    columns: [0, 1, 2, 3, 4, 5] // Columnas a copiar
                }
            },
            {
                "extend": "excelHtml5",
                "text": '<i class="fas fa-fw fa-file-excel"></i>',
                "className": "btn btn-success",
                "exportOptions": {
                "columns": [0, 1, 2, 3, 4, 5] // Columnas a exportar
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
                "columns": [0, 1, 2, 3, 4, 5] // Columnas a exportar
                }
            }
            ]
        });
        });

</script>

    <script> console.log('Hi!'); </script>
@stop