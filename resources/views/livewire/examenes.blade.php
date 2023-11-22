<div>
    {{-- The whole world belongs to you. --}}
    
    <div>

        <div class="card">
            <div class="card-header">                
                
                <h2><b>{{$curso->nombre_curso}} </b></h2>

                <div class="input-group row-auto">
                    <div class="col-md-2">
                        <input type="date" class="form-control" wire:model="newfecha" required>
                        @error('newfecha') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-9">
                        <input type="text" class="form-control" wire:model="busqueda" wire:keydown.enter="toggleSearching" placeholder="Buscar..." required>
                    @error('busqueda') <span class="text-danger">{{ $message }}</span> @enderror

                    </div>
                    <div class="col-md-1">
                        
                    @if ($buscando)
                    <button class="btn btn-danger" wire:click="toggleSearching"><i class="bi bi-x-lg"></i></button>

                    @else
                    <button class="btn btn-primary" wire:click="toggleSearching"><i class="bi bi-search"></i></button>

                    @endif
                    </div>
                </div>

                @if ($buscando)
                @if ($resultados->isEmpty())
                <div class="card" id="resultados-busqueda">
                    <div class="card-body">
                        <p>No se encontraron resultados para la búsqueda </p>
                    </div>
                </div>

                @else
                <div class="card" id="resultados-busqueda">
                    <ul>
                        @foreach ($resultados as $personal)
                                <div class="input-group row g-3">
                                    <div class="col-md-1">{{ $personal->no_socio }}</div>
                                    <div class="col-md-5">
                                        {{ $personal->p_apellido }} {{ $personal->s_apellido }} {{ $personal->nombre }}
                                    </div>
                                    <div class="col-md-2">{{ $personal->curp }}</div>
                                    <div class="col-md-1">
                                        <label for="calif" class="col-form-label">Calificacion</label>

                                    </div>
                                    <div class="col-md-2">
                                        <input id="calif" type="number" class="form-control" min="0" max="10" wire:model="calif" >
                                        
                                    </div>
                                    <div class="col-md-1">
                                        <button class="btn btn-primary" 
                                        wire:click="calificar('{{ $personal->curp }}')">
                                        <i class="bi bi-plus"></i>
                                        </button>
                                    </div>
                                </div>
                        @endforeach
                    </ul>
                    
                </div>
                
                
                @endif
                
                @endif
                
            </div>
            <div class="card-body">
                @if (!empty($participantes))
        <table id="participantes" class="table table-sm table-light table-striped">
            <thead>
                <tr>
                    <th>No. Socio</th>
                    <th>Nombre</th>
                    <th>Ceco</th>
                    <th>Departamento</th>
                    <th>Fecha de Asistencia</th>
                    <th>Calificación</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($participantes as $p)
                <tr>
                    <td>{{ $p->personal->no_socio }}</td>
                    <td>{{ $p->personal->p_apellido }} {{ $p->personal->s_apellido }} {{ $p->personal->nombre}}</td>
                    <td>{{ $p->personal->departamento->ceco }}</td>
                    <td> {{$p->personal->departamento->nombre}} </td>
                    <td>@foreach ($p->personal->participante as $pa) 
                        {{$pa->fecha_asistencia}}
                    @endforeach
                    </td>
                    <td>{{ $p->calificacion }}</td>

                    
                </tr>
                @empty
                    Sin datos
                @endforelse
            
            </tbody>
        </table>
    @else
        <tr> <td colspan="6">No hay elementos seleccionados.</td></tr>
    @endif
                </tbody>
            </table>

            <div class="card-footer text-muted">
                <table class="table table-sm table-light">
                    <tbody>
                        <tr class="text-right">
                            <td>       </td>
                            <td>       </td>
                            <td><b>Resultados</b></td>
                            <td> Examentes realizados: {{$cuenta->total_registros}} </td>
                            <td >Promedio General: {{ number_format(($cuenta->suma_calificaciones / $cuenta->total_registros), 2) }} </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        
    </div>
    
    
    
</div>
