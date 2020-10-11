@extends('layouts.app1')

@section('content')
<div class="container-fluid my-5">
    <div class="row justify-content-center my-5" >
        <div class="col-md-12">
            <div class="card border-secondary">
                <div class="card-header grey text-white title">
                    <h3><strong>Cofigurar Oficina "{{$oficina->denominacion}}"</strong></h3>
                 </div>
                 
                <div class="card-body justify-content-center row">                    
                    <div class="col-md-4 border-right border-danger">
                        <h4 class="my-3 title"><strong>Agregar Tramite</strong></h4><hr class="border-red">
                        
                        <form action="{{route('config.create')}}" method="POST">
                            @csrf
                            <input type="hidden" name="oficina_id" value="{{$oficina->id}}">
                            <div class="form-group">
                                <label for="tramite_id"><strong>Tramite</strong></label>
                                <select name="tramite_id" id="tramite_id" class="form-control @error('tramite_id') is-invalid @enderror">
                                    <option selected disabled>--Seleccionar Lugar--</option>
                                    @foreach($tramites as $tramite)
                                    <option value="{{$tramite->id}}">{{$tramite->denominacion}}</option>    
                                    @endforeach    
                                </select>
                                @error('tramite_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="hora_inicio"><strong>Dias de Atención</strong></label><br>
                                <div class="form-check form-check-inline">
                                  <input class="form-check-input" type="checkbox" name="case[1]" value="1">
                                  <label class="form-check-label" for="inlineCheckbox1">Lunes</label>
                                </div>
                                <div class="form-check form-check-inline">
                                  <input class="form-check-input" type="checkbox" name="case[2]" value="2">
                                  <label class="form-check-label" for="inlineCheckbox2">Martes</label>
                                </div>
                                <div class="form-check form-check-inline">
                                  <input class="form-check-input" type="checkbox" name="case[3]" value="3">
                                  <label class="form-check-label" for="inlineCheckbox3">Miercoles</label>
                                </div>
                                <div class="form-check form-check-inline">
                                  <input class="form-check-input" type="checkbox" name="case[4]" value="4">
                                  <label class="form-check-label" for="inlineCheckbox4">Jueves</label>
                                </div>
                                <div class="form-check form-check-inline">
                                  <input class="form-check-input" type="checkbox" name="case[5]" value="5">
                                  <label class="form-check-label" for="inlineCheckbox5">Viernes</label>
                                </div>
                                <div class="form-check form-check-inline">
                                  <input class="form-check-input" type="checkbox" id="todos">
                                  <label class="form-check-label" for="inlineCheckbox5">todos</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="hora_inicio"><strong>Hora de Inicio de Atención</strong></label>
                                <input id="hora_inicio" type="time" value="{{ old('hora_inicio') }}" class="form-control" name="hora_inicio" placeholder="00:00" required>
                            </div>
                            <div class="form-group">
                                <label for="hora_fin"><strong>Hora de Cierre de Atención</strong></label>
                                <input id="hora_fin" type="time" class="form-control" value="{{ old('hora_fin') }}" name="hora_fin" placeholder="00:00" required>
                            </div>
                            <div class="form-group">
                                <label for="min_turno"><strong>Minutos entre turnos</strong></label>
                                <input id="min_turno" type="number" class="form-control" name="min_turno" value="{{ old('min_turno') }}" required>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-outline-primary btn-block title"><h5><strong><i class="fas fa-plus"></i> Añadir Tramite</strong></h5></button>
                            </div>
                        </form>  

                    </div>

                    <div class="col-md-8 my-3">
                        <h4 class="title"><strong>Listado de Tramites</strong></h4>
                        <hr class="border-red">
                        @if(session('message'))
                            <div class="alert alert-{{ session('status') }}">
                                <strong>{{ session('message') }}</strong>
                            </div>  
                        @endif
                        @if(count($oficina->config))
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <th>Denominación</th>
                                    <th>Dias Atención</th>
                                    <th>Inicio</th>
                                    <th>Cierre</th>
                                    <th>Min. Turno</th>
                                    <th>Acciones</th>
                                </thead>
                                <tbody>
                                    @foreach($oficina->config as $config)
                                    <tr>
                                        <td>{{$config->tramite->denominacion}}</td>
                                        <td>
                                            @for($i=0; $i<5; $i++)
                                                @if(isset($config->dias[$i]))
                                                    @switch($config->dias[$i])
                                                        @case(1)
                                                            Lunes 
                                                        @break
                                                        @case(2)
                                                             Martes 
                                                        @break
                                                        @case(3)
                                                             Miercoles 
                                                        @break
                                                        @case(4)
                                                             Jueves 
                                                        @break
                                                        @case(5)
                                                             Viernes
                                                        @break
                                                    @endswitch
                                                @endif
                                            @endfor
                                        </td>
                                        <td>{{date('H:i', strtotime($config->hora_inicio))}}</td>
                                        <td>{{date('H:i', strtotime($config->hora_fin))}}</td>
                                        <td>{{$config->min_turno}}</td>
                                        <td>
                                            <!--
                                            <a href="#" class="btn btn-success"><i class="fas fa-edit"></i></a>
                                            -->
                                            <a href="#" class="btn btn-outline-success" data-toggle="modal" data-target="#editModal" onclick="edit({{$oficina->id}}, '{{$config->id}}','{{$config->tramite->denominacion}}', '{{$config->hora_inicio}}','{{$config->hora_fin}}','{{$config->min_turno}}')"><i class="fas fa-edit"></i></a>
                                            <a href="#" class="btn btn-outline-danger" onclick="Borrar({{$oficina->id}},{{$config->id}},'{{$config->tramite->denominacion}}')" data-toggle="modal" data-target="#confirm" title="Eliminar"><i class="fas fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>      
                        @else
                        <h3 class="text-danger text-center"><strong>No Existen oficinas...</strong></h3>
                        @endif
                    </div>                    
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editModal">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
                              
            <!-- Modal Header -->
            <div class="modal-header bg-primary text-white">
                <h4 class="modal-title"><strong>Actialuzar Tramite</strong></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
                                
            <!-- Modal body -->
            <div class="modal-body my-3">
                <form method="POST" action="{{route('config.update')}}">
                    @csrf
                    <input type="hidden" name="oficina_id" id="eoficina">
                    <input type="hidden" name="config_id" id="econfig">
                    <div class="form-group">
                        <label for="tramite_id"><strong>Tramite</strong></label>
                        <input id="etramite_id" type="text" class="form-control" name="tramite_id" disabled required>
                    </div>
                    <div class="form-group">
                        <label for="hora_inicio"><strong>Hora de Inicio de Atención</strong></label>
                         <input id="ehora_inicio" type="time" value="{{ old('hora_inicio') }}" class="form-control" name="hora_inicio" placeholder="00:00" required>
                    </div>
                    <div class="form-group">
                        <label for="hora_fin"><strong>Hora de Cierre de Atención</strong></label>
                        <input id="ehora_fin" type="time" class="form-control" value="{{ old('hora_fin') }}" name="hora_fin" placeholder="00:00" required>
                    </div>
                    <div class="form-group">
                        <label for="min_turno"><strong>Minutos entre turnos</strong></label>
                        <input id="emin_turno" type="number" class="form-control" name="min_turno" value="{{ old('min_turno') }}" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success btn-block"><h5><strong> Actualizar Configuracion</strong></h5></button>
                    </div>  
                </form>
            </div>
        </div>
    </div>
</div> 

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="confirm">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel"><strong>¿Estas seguro de realizar esta accion?</strong></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal" data-toggle="modal" data-target="#confirm-si">Si</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="confirm-si">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">¿Desea eliminar el tramite <strong>"<span id="nombre"></span>"</strong>?</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <form method="POST" action="{{route('config.delete')}}">
          @csrf
          <input type="hidden" name="id" id="config" value="">
          <input type="hidden" name="oficina_id" id="oficina" value="">
          <input type="hidden" name="tramite" id="name" value="">
          <div class="modal-footer">
            <button type="submit" class="btn btn-danger">Si</button>
            <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
          </div>
      </form>
    </div>
  </div>
</div>

@endsection
@section('script')
    <script type="text/javascript" src="{{asset('js/config.js')}}"></script>
@endsection
