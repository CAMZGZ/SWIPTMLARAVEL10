@extends('adminlte::page')

@section('title', 'Empresas')

@section('content_header')
    <h1>Empresas</h1>
@stop
@section('plugins.Datatables', true)
@section('plugins.Databuttons', true)


@section('content')
<div id="t_empresas">
    <div class="table-responsive">
            <div class="text-right mb-2">
                <a class="btn btn-primary" href="{{route('empresa.create')}}" role="button" onclick=""> Agregar</a>
                <button @click ="excel" class="btn btn-success">Excel</button>
                <button  @click = "pdf" class="btn btn-danger">PDF</button>
                <a class="btn btn-warning" href="{{ route('empresa.bajas') }}" role="button" onclick=""> Bajas</a>
            </div>    
    
        <table id="myTable" class="table table-striped, align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Razon Social</th> 
                    <th>RFC</th>
                    <th> Opciones</th>
                </tr>    
            </thead>
            <tbody>
                @forelse ($empresas as $e )
                <tr class="align-middle">
                    <td> 
                        <a href="{{route('empresa.show', $e->id)}}" class="text-dark"> 
                        {{$e->razon_social}}
                    </a>
                </td>
                    <td>  {{$e->rfc}} </td>
                    <td class="align-middle"> 
                    <center>
                        <a class="btn btn-info" 
                        href="{{route('empresa.edit', $e->id)}}" role="button" onclick="">
                        <i class="fas fa-fw fa-pen"></i>
                        </a>
                        
                    </center>
                    </td>
                    
                </tr>    
                @empty
                    <p> No data</p>
                @endforelse
                
            </tbody>
        </table>
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
        let table = new DataTable('#myTable');
    </script>
    
@stop