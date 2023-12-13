@extends('adminlte::page')

@section('title', 'Cursos A Los Que Han Asistido Los Empleados')

@section('content_header')

@stop

@section('content')
<br>
    <div class="card">
        <div class="card-header">
            <h2><b>Cursos A Los Que Han Asistido Los Empleados</b></h2>
        </div>
        <div class="card-body">
            <div class="card-body">
                <button class="btn btn-danger" type="submit" role="button"
                data-toggle="tooltip" title="Descargar en PDF" 
                onclick="window.location.href='{{route('curso.apdf')}}'">
                <i class="fas fa-fw fa-file-pdf"> </i></button>
            </div>
            <table id="AsistenciaP" class="table table-sm">
                <thead class="table table-dark">
                    <tr>
                        <th class="text-center">Número <br> de Socio</th>
                        <th>Nombre Completo</th>
                        <th>Departamento</th>
                        <th> Cursos Tomados</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($personal as $p)
                        <tr>
                            <td class="text-center">{{$p->no_socio}}</td>
                            <td>{{$p->p_apellido.' '.$p->s_apellido.' '.$p->nombre}}</td>
                            <td>{{$p->departamento->nombre}}</td>
                            <td>
                                <ul>
                                    <li>
                                @forelse ($p->cursosAsistidos as $c)
                                
                                        {{$c->nombre_curso}}   
                                @empty
                                No ha tomado cursos aún <i class="bi bi-emoji-frown"></i>
                                @endforelse
                            </li>
                        </ul>
                            </td>
                        </tr>
                    @empty
                        
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer text-muted">
            Footer
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
            $('#AsistenciaP').DataTable({
                "language": {
                "lengthMenu": "Mostrar _MENU_ registros por página",
                "zeroRecords": "No hay resultados",
                "info": "Página _PAGE_ de _PAGES_",
                "infoEmpty": "Sin Datos",
                "infoFiltered": "(Obtenido de un total de _MAX_  Registros)",
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
@stop