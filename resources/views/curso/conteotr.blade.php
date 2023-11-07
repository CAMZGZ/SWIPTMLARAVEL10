@extends('adminlte::page')

@section('title', 'Conteo en tiempo Real')

@section('content_header')

@stop
@section('plugins.Datatables', true)
@section('plugins.Databuttons', true)


@section('content')
<br>
<div class="card">
    <div class="card-head">
        <p></p>
        <!--<h2 style="text-indent: 0.4cm;"><b>Conteo en tiempo Real</b></h2>-->
    </div>
    
    <div class="card-body">

        <table id="CursosT" class="table table-sm table-striped">
            
            <thead>
                <tr>
                    <th colspan="6" class="table-success text-center">
                        <h1><b>Asistencia a curso: {{$curso->nombre_curso}}</b></h1>
                        <h2><b> {{$curso->fecha_inicio}} a {{$curso->fecha_fin}} </b></h2>
                    </th>
                </tr>
                <tr>
                    <th colspan="6" class="table-warning text-center">
                        <h2><b> {{ now()->format('d/m/Y') }} </b></h2>
                    </th>
                </tr>
                
                <tr class="table-primary text-center">
                    <th>CR</th>
                    <th class="text-justify">Área</th>
                    <th >Socios</th>
                    <th >Asistencias</th>
                    <th >Faltas</th>
                    <th >Porcentaje</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($participantes as $p)
                @if ($p->participantesa===$p->nparticipantes)    
                <tr class="table-success text-center">
                    @else
                    <tr class="text-center">
                        @endif
                        <td>{{ $p->ceco }}</td>
                        <td class="text-justify">{{ $p->nombre }}</td>
                        <td >{{ $p->nparticipantes }}</td>
                        <td>{{ $p->participantesa }}</td>
                        <td>{{ $p->participantesf }}</td>                        
                        <td>{{ number_format(($p->participantesa / $p->nparticipantes)*100, 2)  }} %</td=>
                    </tr>
                @endforeach
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
            buttons: [
                {
                    extend: 'excelHtml5',
                    exportOptions: {
                    customize: function(doc) {
                        // Personaliza el formato de los datos exportados
                        var table = doc.content[1].table;
                        var rowLength = table.body[0].length;
                        for (var i = 0; i < rowLength; i++) {
                        table.body[0][i].fillColor = '#007bff'; // Color de encabezados
                        table.body[0][i].color = '#fff'; // Color de texto de encabezados
                        }
                    }
                    }
                },
                {
                    extend: 'pdfHtml5',
                    exportOptions: {
                    customize: function(doc) {
                        // Personaliza el formato de los datos exportados
                        var table = doc.content[1].table;
                        var rowLength = table.body[0].length;
                        for (var i = 0; i < rowLength; i++) {
                        table.body[0][i].fillColor = '#007bff'; // Color de encabezados
                        table.body[0][i].color = '#fff'; // Color de texto de encabezados
                        }
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