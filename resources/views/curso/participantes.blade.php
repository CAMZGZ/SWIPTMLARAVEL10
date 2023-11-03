@extends('adminlte::page')

@section('title', 'Socios Inscritos: '.$curso->nombre_curso)


@section('content_header')
@stop

@section('plugins.Sweetalert2', true)

@section('content')
<div class="card">
    <div class="card-head">
        <br>
        <h2 style="text-indent: 0.4cm;"><b>{{$curso->nombre_curso}}</b></h2>
    </div>
    <div class="card-body text-ellipsis text-right">
        <div style="display: inline-block; margin-top: 0px;">
            <form method="GET" action="{{ route('participante.delete') }}">
                @csrf
                <input type="hidden" name="curso_id" value="{{ $curso->id }}">
                <button id="reactivate" class="btn btn-danger" type="submit" role="button"
                data-toggle="tooltip" title="Eliminar Participantes" 
                > 
                    <i class="fas fa-fw fa-user-minus"></i></button>
            </form>
        </div>
        <div style="display: inline-block; margin-top: 0px;">
            <form method="GET" action="{{ route('participante.create') }}">
                @csrf
                <input type="hidden" name="curso_id" value="{{ $curso->id }}">
                <button id="reactivate" class="btn btn-success" type="submit" role="button"
                data-toggle="tooltip" title="Agregar Participantes" 
                > 
                    <i class="fas fa-fw fa-user-plus"></i></button>
            </form>
        </div>
    </div>
    <div class="card-body">
        <table id="Participantes" class="table table-striped"">
            <thead class="table-dark">
                <tr>
                    <th>Número de socio</th>
                    <th>Nombre</th>
                    <th>Curp</th>
                    <th>Departamento</th>           
                </tr>    
            </thead>
            <tbody>
                @forelse ($participantes as $p )
                <tr class="text-justify">
                    <td> {{$p-> personal -> no_socio}}</td>
                    <td> 
                        {{$p -> personal -> p_apellido}} {{$p -> personal -> s_apellido}} {{$p -> personal -> nombre}}
                        
                    </td>
                    <td> {{$p -> personal -> curp}} </td>
                    <td> {{$p -> personal ->departamento -> nombre}} </td>
                    
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

<div class="text-right mb-2">

    <a class="btn btn-warning" 
    href="{{ $curso->estatus == 1 ? route('curso.index') : route('curso.index') }}" 
    role="button" onclick=""><i class="fas fa-fw fa-arrow-left"></i></a>

</div>





@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
    
    <script>
        const deleteForm = document.getElementById('delete-form');
        delete.addEventListener('submit', function(event) {
        event.preventDefault();
        Swal.fire({
            title: '¿Estás seguro de eliminarlo?',
            text: "Esta acción no se puede deshacer",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                deleteForm.submit();
            }
        });
    });
    </script>
    <script>
        $(document).ready(function() {
            $('#Participantes').DataTable({
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
                "responsive": true
            });
            });
    </script>
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
@stop