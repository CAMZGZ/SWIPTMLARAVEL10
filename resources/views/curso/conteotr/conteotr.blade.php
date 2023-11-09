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
        <button class="btn btn-danger" type="submit" role="button"
        data-toggle="tooltip" title="Descargar en PDF" 
        onclick="window.location.href='{{route('curso.pdfconteo', $curso->id)}}'">
        <i class="fas fa-fw fa-file-pdf"> </i></button>
    </div>

    <div class="card-body">
        <table id="CursosT" class="table table-sm table-striped">
            
            <thead>
                <tr>
                    <th colspan="7" class="table-success text-center">
                        <h1><b>Asistencia a curso: {{$curso->nombre_curso}}</b></h1>
                        <h2><b> {{ \Carbon\Carbon::parse($curso->fecha_inicio)->format('d') }} al 
                            {{ \Carbon\Carbon::parse($curso->fecha_fin)->format('d') }} de 
                            {{ \Carbon\Carbon::parse($curso->fecha_inicio)->formatLocalized('%B') }}
                            de {{ \Carbon\Carbon::parse($curso->fecha_inicio)->format('Y') }}</b></h2>
                    </th>
                </tr>
                <tr>
                    <th colspan="7" class="table-warning text-center">
                        <h3><b> {{ now()->format('d/m/Y') }} </b></h3>
                    </th>
                </tr>
                
                <tr class="table-primary text-center">
                    <th class="text-center"">CR</th>
                    <th>Encargado</th>
                    <th class="text-justify">Área</th>
                    <th class="text-center"">Socios</th>
                    <th class="text-center"">Asistencias</th>
                    <th class="text-center"">Faltas</th>
                    <th class="text-center"">Porcentaje</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($departamentos as $d)
                @if ($d['participantesa']===$d['nparticipantes'])    
                <tr class="table-success text-center">
                    @else
                    <tr class="text-center">
                        @endif
                        <td>{{ $d['ceco'] }}</td>
                        <td class="text-justify">{{$d['jefe']}}</td>
                        <td class="text-justify">{{ $d['area'] }}</td>
                        <td >{{ $d['nparticipantes'] }}</td>
                        <td>{{ $d['participantesa'] }}</td>
                        <td>{{ $d['participantesf'] }}</td>                        
                        <td>{{ $d['porcentaje']}} %</td=>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="text-right mb-2">

        <a class="btn btn-warning" 
        href="{{ route('curso.listas', $curso->id) }}" 
        role="button" onclick=""><i class="fas fa-fw fa-arrow-left"></i></a>
    
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
            
            
        });
        });

</script>

<script>
    $(function () {
      $('[data-toggle="tooltip"]').tooltip()
    })
  </script>
@stop