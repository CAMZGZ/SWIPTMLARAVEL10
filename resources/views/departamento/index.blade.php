@extends('adminlte::page')

@section('title', 'Departamentos')

@section('content_header')
    <h1>Departamentos</h1>
@stop
@section('plugins.Datatables', true)

@section('content')
<div id="t_empresas">
    <div class="table-responsive">
            <div class="text-right mb-2">
                <a class="btn btn-primary" href="{{route('departamento.create')}}" role="button" onclick=""> Agregar</a>
                <button @click ="excel" class="btn btn-success">Excel</button>
                <button  @click = "pdf" class="btn btn-danger">PDF</button>
                <a class="btn btn-warning" href="{{ route('departamento.bajas') }}" role="button" onclick=""> Bajas</a>
            </div>    
    
        <table id="myTable" class="table table-striped, align-middle">
            <thead class="table-dark">
                <tr>
                    <th>CECO</th> 
                    <th>Departamento</th>
                    <th>Empresa</th>
                    <th> Opciones</th>
                </tr>    
            </thead>
            <tbody>
                @forelse ($departamentos as $d )
                <tr class="align-middle">
                    <td> 
                        <a href="{{route('departamento.show', $d->id)}}" class="text-dark"> 
                        {{$d -> ceco}}
                    </a>
                </td>
                    <td>  {{$d->nombre}} </td>
                    <td>{{$d->empresa-> razon_social}}</td>
                    <td class="align-middle"> 
                    <center>
                        <a class="btn btn-info" 
                        href="{{route('departamento.edit', $d->id)}}" role="button" onclick="">
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
   
    
@stop