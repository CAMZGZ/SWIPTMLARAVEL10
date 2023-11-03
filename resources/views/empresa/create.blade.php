@extends('adminlte::page')

@section('title', 'Registrar Empresa')

@section('content_header')
    <h1>Registrar Empresa</h1>
@stop

@section('content')
<Form method="POST" action="{{route('empresa.store')}}">
@csrf
<div class="card">
    @csrf
    <h5 class="card-header">RFC</h5>
    <div class="card-body">
      <h5 class="card-title"> Ingresa el RFC de la empresa</h5>
      <input  type="text" class="form-control" name="rfc" required>
  
      
    </div>
  </div>
  
    <div class="card">
        <h5 class="card-header">Razón Social</h5>
        <div class="card-body">
        <h5 class="card-title"> Ingresa el nombre completo de la empresa</h5>
        <input type="text" class="form-control" name="razon_social" required>
    </div>  

    <div class="text-right mb-6">
        <button type="submit" class="btn btn-success">Guardar</button> 
        <a class="btn btn-danger" href="{{route('empresa.index')}}" role="button" onclick=""> Cancelar</a> 
    </div>  
</Form>
@stop

@section('css')

    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script> console.log('Hi!'); </script>
@stop