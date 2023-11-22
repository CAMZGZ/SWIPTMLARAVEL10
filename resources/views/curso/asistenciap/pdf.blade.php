<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!--
        <img src="\public\vendor\swiptm\img\ptml_ogo.png">
    -->
</head>
<body>

    <style>
        .table-title{
            background-color: rgb(203, 29, 29);

            color: whitesmoke;
        }
        .table-encabezado{
            background-color: #455963;
            color: whitesmoke;
        }
        
        
        </style>
        
        
        <style>
            /* Estilo para la tabla */
            .table {
                width: 100%;
                border-collapse: separate;                
                border-spacing: 0;

            }
            
            /* Estilo para las filas pares del cuerpo de la tabla */
            .table tbody tr:nth-child(even) {
                background-color: #f2f2f2;
            }
            
            /* Estilo para justificar el contenido a la izquierda */
            .center-align {
                text-align: center;
            }
            
            /* Elimina los bordes verticales en el cuerpo de la tabla */
            .table tbody tr td {
            }
        </style>
        
    <table id="AsistenciaP" class="table">
        <thead>
            <tr>
                <th colspan="4" class="table-title text-center">
                    <br>
                    <font size=5>Cursos A Los Que Han Asistido El Personal</font>
                    <br>
                </th>
            </tr>
            <tr class="table-encabezado">
                <th class="center-align"><br>Número <br> de Socio
                    <br>
                </th>
                <th>Nombre Completo</th>
                <th>Departamento</th>
                <th>Cursos Tomados</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($personal as $p)
                <tr>
                    <td class="center-align">{{$p->no_socio}}</td>
                    <td>{{$p->p_apellido.' '.$p->s_apellido.' '.$p->nombre}}</td>
                    <td>{{$p->departamento->nombre}}</td>
                    <td>
                        @forelse ($p->cursos as $c)
                        <ul>
                            <li>
                                {{$c->nombre_curso}}
                            </li>
                        </ul>
                            
                        @empty
                            No ha asistido a ningún curso
                        @endforelse
                    </td>
                </tr>
            @empty
                
            @endforelse
        </tbody>
    </table>
</body>
</html>