@extends('adminlte::page')

@section('title', 'Departamento')

@section('content_header')
@stop


@section('content')
<div class="card">

    <div class="card-header">
            <h2>Registrar Departamento</h2>
    </div>
    <div class="card-body">
    
        <form class="row g-3">
            <div class="col-md-4">
                <label for="p_apellido" class="form-label">Ceco</label></label>
                <input type="text" class="form-control" id="p_apellido" >
            </div>

            <div class="col-md-8">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" >
            </div>
            <div class="col-md-6">

                <label for="personal_id" class="form-label">Jefe</label>
                <select id="personal_id" class="form-select">

                @forelse ($empresa as $e)
                <option selected value="{{$e->id}}">{{$e->razon_social}}</option>
                @empty

                @endforelse
                </select>
            </div>
            <div class="col-md-4">

                <label for="personal_id" class="form-label">Jefe</label>
                <select id="personal_id" class="form-select">

                @forelse ($personal as $p)
                <option selected value="{{$p->id}}">{{$p->p_apellido}} {{$p->s_apellido}} {{$p->nombre}}</option>
                @empty

                @endforelse
                </select>
            </div>
            <div class="text-right mb-6">
                <button class="btn btn-primary" type="submit"><i class="bi bi-floppy"></i></button>
                <a href="{{route('personal.index')}}" class="btn btn-danger"><i class="bi bi-arrow-90deg-left"></i></a>
            </div>

        </form>
    </div>
</div>
<div id="example-table"></div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>

    
@stop