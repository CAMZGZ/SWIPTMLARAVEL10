@extends('adminlte::page')

@section('title', 'Empresas')

@section('content_header')
    <h>Empresas</h
@stop

@section('plugins.Sweetalert2', true)

@section('content')


<div class="row">
  <div class="col-sm-6 mb-3 mb-sm-0">
    <div class="card">
      <div class="card-body text-capitalize text-center">
        <h5 class="card-title">
            RFC
        </h5>
        <p class="card-text">
        {{$empresa->rfc}}    
    </p>
      </div>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="card">
      <div class="card-body text-capitalize text-center">
        <h5 class="card-title">
            Razón Social
        </h5>
        <p class="card-text">
        {{$empresa->razon_social}}
        </p>
        
      </div>
      
    </div>
  </div>
</div>
<div class="text-right mb-2">

    <a class="btn btn-info" href="{{route('empresa.edit', $empresa->id)}}" role="button" onclick="">Editar</a>

</div>
<div class="text-right mb-2">
    @if ($empresa->estatus == 1)
        <form id="delete-form" method="POST" action="{{route('empresa.destroy', $empresa->id)}}">
            @csrf
            @method('DELETE')
            <button id="delete" class="btn btn-danger" type="submit" role="button" >Eliminar</button>
        </form>
    @elseif ($empresa->estatus == 0)
    <form method="POST" action="{{ route('empresa.activar') }}">
        @csrf
        <input type="hidden" name="empresa_id" value="{{ $empresa->id }}">
        <button id="reactivate" class="btn btn-success" type="submit" role="button">Reactivar</button>
    </form>
    
    @endif
</div>

<div class="text-right mb-2">
    <a class="btn btn-warning" 
    href="{{ $empresa->estatus == 1 ? route('empresa.index') : route('empresa.bajas') }}" 
    role="button" onclick="">Regresar</a>
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
@stop