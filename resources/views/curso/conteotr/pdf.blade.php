<style>
.table-title{
    background-color: #2fab71;
    color: whitesmoke;
}
.table-encabezado{
    background-color: #2f75ab;
    color: whitesmoke;
}
.table-fecha{
    background-color: rgba(235, 132, 5, 0.804);
    color: black;
}
.table-success{
    background-color: rgba(11, 152, 11, 0.836);
    color: rgb(57, 67, 59);
}


</style>


<style>
    /* Estilo para la tabla */
    .table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        text-align: center;
    }
    
    /* Estilo para las filas pares del cuerpo de la tabla */
    .table tbody tr:nth-child(even) {
        background-color: #f2f2f2;
    }
    
    /* Estilo para justificar el contenido a la izquierda */
    .left-align {
        text-align: left;
    }
    
    /* Elimina los bordes verticales en el cuerpo de la tabla */
    .table tbody tr td {
        border: none;
    }
</style>
    
    
    
<table id="CursosT"  class="table">
            
    <thead>
        <tr>
            <th colspan="7" class="text-center">
                <img src="vendor\swiptm\img\encabezado_2.png" alt="" width="700px">

            </th>

        </tr>
        <tr>
            <th colspan="7">
                <br>
            </th>
        </tr>
        <tr>
            <th colspan="7" class="table-title text-center">
                <h1><b>Asistencia a curso: {{$curso->nombre_curso}}</b></h1>
                <h2><b> {{ \Carbon\Carbon::parse($curso->fecha_inicio)->format('d') }} al 
                    {{ \Carbon\Carbon::parse($curso->fecha_fin)->format('d') }} de 
                    {{ \Carbon\Carbon::parse($curso->fecha_inicio)->formatLocalized('%B') }}
                    de {{ \Carbon\Carbon::parse($curso->fecha_inicio)->format('Y') }}</b></h2>
            </th>
        </tr>
        <tr>
            <th colspan="7" class="table-fecha text-center">
                <h3><b> {{ now()->format('d/m/Y') }} </b></h3>
            </th>
        </tr>
        
        <tr class="table-encabezado">
            <th class="text-center">CR</th>
            <th >Encargado</th>
            <th >Área</th>
            <th class="text-center">Socios</th>
            <th class="text-center">Asistencias</th>
            <th class="text-center">Faltas</th>
            <th class="text-center">Porcentaje</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($departamentos as $d)
        @if ($d['participantesa']===$d['nparticipantes'])    
        <tr class="table-success text-center">
            @else
            <tr>
                @endif
                <td class="text-center">{{ $d['ceco'] }}</td>
                <td class="left-align">{{$d['jefe']}}</td>
                <td class="left-align">{{ $d['area'] }}</td>
                <td class="text-center">{{ $d['nparticipantes'] }}</td>
                <td class="text-center">{{ $d['participantesa'] }}</td>
                <td class="text-center">{{ $d['participantesf'] }}</td>                        
                <td class="text-center">{{ $d['porcentaje']}} %</td=>
            </tr>
        @endforeach
    </tbody>
</table>

