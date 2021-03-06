@extends('layouts.app1')

@section('content')
<div class="container-fluid my-5">
    <div class="row justify-content-center my-5" >
        <div class="col-md-12">
            <div class="card border border-secondary">
                <div class="card-header grey text-white border-buton border-secondary title">
                    <h3><strong>Oficinas</strong></h3>
                 </div>

                <div class="card-body justify-content-center row">                    
                    <div class="col-md-4 border-right border-danger">
                        <h4 class="my-3 title"><strong>Agregar Oficina</strong></h4><hr class="border-red">
                        
                        <form action="{{route('oficina.create')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="name" class="col-form-label text-md-right"><strong>{{ __('Denominación') }}</strong></label>
                                <input id="denominacion" type="text" class="form-control @error('denominacion') is-invalid @enderror" name="denominacion" value="{{ old('denominacion') }}" required autocomplete="name" autofocus>
                                @error('denominacion')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="direccion" class="col-form-label text-md-right"><strong>{{ __('Dirección') }}</strong></label>
                                <input id="direccion" type="text" class="form-control @error('direccion') is-invalid @enderror" name="direccion" value="{{ old('direccion') }}" required autocomplete="Direccion" autofocus>
                                @error('direccion')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="telefono" class="col-form-label text-md-right"><strong>{{ __('Teléfono') }}</strong></label>
                                <input id="telefono" type="text" class="form-control @error('telefono') is-invalid @enderror" name="telefono" value="{{ old('telefono') }}" required autocomplete="telefono" autofocus>
                                @error('telefono')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-outline-primary btn-block title"><h5><strong><i class="fas fa-plus"></i> Agregar Oficina</strong></h5></button>
                            </div>
                        </form>  

                    </div>

                    <div class="col-md-8 my-3">
                        <h4 class="title"><strong>Listado de Oficinas</strong></h4>
                        <hr class="border-red">
                        @if(session('message'))
                            <div class="alert alert-{{ session('status') }}">
                                <strong>{{ session('message') }}</strong>
                            </div>  
                        @endif
                        @if(count($oficinas))
                        <div class="table-responsive">
                            <table class="table text-center">
                                <thead>
                                    <th>Denominación</th>
                                    <th>Dirección</th>
                                    <th>Teléfono</th>
                                    <th>Acciones</th>
                                </thead>
                                <tbody>
                                    @foreach($oficinas as $oficina)
                                    <tr>
                                        <td>{{$oficina->denominacion}}</td>
                                        <td>{{$oficina->direccion}}</td>
                                        <td>{{$oficina->telefono}}</td>
                                        <td>
                                            <a href="#" class="btn btn-outline-primary" onclick="edit('{{$oficina->id}}','{{$oficina->denominacion}}','{{$oficina->direccion}}','{{$oficina->telefono}}')" data-toggle="modal" data-target="#editModal" title="Editar Usuario"  ><i class="fas fa-edit"></i></a>
                                            <a href="{{route('config.index',[$oficina->id])}}" class="btn btn-outline-secondary" title="Configuracion"><i class="fas fa-cog"></i></a>
                                            <a href="#" class="btn btn-outline-danger" onclick="Borrar({{$oficina->id}},'{{$oficina->denominacion}}')" data-toggle="modal" data-target="#confirm" title="Eliminar"><i class="fas fa-trash-alt"></i></a>
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
                <h4 class="modal-title"><strong>Actualizar Oficina</strong></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
                                
            <!-- Modal body -->
            <div class="modal-body my-3">
                <form method="POST" action="{{route('oficina.update')}}">
                    @csrf
                    <input type="hidden" name="id" id="id">
                    <div class="form-group">
                        <label for="ename" class="col-form-label text-md-right"><strong>{{ __('Denominación') }}</strong></label>
                        <input id="edenominacion" type="text" class="form-control" name="denominacion">
                    </div>
                    <div class="form-group">
                        <label for="direccion" class="col-form-label text-md-right"><strong>{{ __('Dirección') }}</strong></label>
                        <input id="edireccion" type="text" class="form-control" name="direccion" required>
                    </div>
                    <div class="form-group">
                        <label for="telefono" class="col-form-label text-md-right"><strong>{{ __('Teléfono') }}</strong></label>
                        <input id="etelefono" type="text" class="form-control" name="telefono">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success btn-block"><h5><strong>Actualizar Oficina</strong></h5></button>
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
        <h4 class="modal-title" id="myModalLabel">¿Desea eliminar la oficina <strong>"<span id="nombre"></span>"</strong>?</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <form method="POST" action="{{route('oficina.delete')}}">
          @csrf
          <input type="hidden" name="id" id="oficina" value="">
          <input type="hidden" name="oficina" id="name" value="">
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
    <script type="text/javascript" src="{{asset('js/oficinas.js')}}"></script>
@endsection
