@extends('adminlte::page')

@section('title', 'Empresas')

@section('content_header')
    <h1>Empresas</h1>
@stop

@section('content')
<div id="t_empresas">
    <div class="table-responsive">
            <div class="text-right mb-2">
                <button @click ="excel" class="btn btn-success">Excel</button>
                <button  @click = "pdf" class="btn btn-danger">PDF</button>
                
            </div>    
    
        <table class="table table-striped, align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Razon Social</th> 
                    <th>RFC</th>
                    
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
                </tr>
    
                @empty
                
                    <td>no data</td>
                    <td>
                    </td>
                
                @endforelse
            
            </tbody>
        </table>
    </div>
</div>
<div class="text-right mb-2">
    <a class="btn btn-danger" href="{{route('empresa.index')}}" role="button" onclick=""> Regresar</a>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop