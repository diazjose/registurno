@extends('layouts.app1')

@section('content')
<div class="container" id="contenedor">
    <div class="row justify-content-center">
        <div class="col">
            <div class="card border-secondary">
                <div class="card-header grey text-white title"><h3><strong><i class="fas fa-users"></i> Usuarios</strong></h3></div>

                <div class="card-body justify-content-center row">
                    <div class="col-md-4 border-right border-danger">
                        <h4 class="my-3 title"><strong>Agregar Usuario</strong></h4><hr class="border-red">
                        
                        <form method="POST" action="{{ route('user.create') }}">
                            @csrf

                            <div class="form-group">
                                <label for="name" class="col-form-label text-md-right">
                                    <strong>{{ __('Nombre:') }}</strong>
                                </label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="surname" class="col-form-label text-md-right">
                                    <strong>{{ __('Apellidos:') }}</strong>
                                </label>
                                <input id="surname" type="text" class="form-control @error('surname') is-invalid @enderror" name="surname" value="{{ old('surname') }}" required autocomplete="surname" autofocus>

                                @error('surname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="email" class="col-form-label text-md-right">
                                    <strong>{{ __('E-Mail Address') }}</strong>
                                </label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="role" class="col-form-label text-md-right">
                                    <strong>{{ __('Rol:') }}</strong>
                                </label>
                                <select name="role" id="role" class="form-control">
                                    <option value="ADMIN">Administrador</option>
                                    <option value="USER">Usuario Turnero</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="oficina" class="col-form-label text-md-right" >
                                    <strong>{{ __('Oficina:') }}</strong>
                                </label>
                                <select name="oficina" id="oficina" class="form-control" >
                                    <option value="0">TODOS</option>
                                    @foreach($oficinas as $o)   
                                    <option value="{{$o->id}}">{{$o->denominacion}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group" id="tipo" style="display: none;">
                                <label for="tramite" class="col-form-label text-md-right" >
                                    <strong>{{ __('Tramite:') }}</strong>
                                </label>
                                <select name="tramite" id="tramite" class="form-control">
                                    <option value="0">TODOS</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="password" class="col-form-label text-md-right">
                                    <strong>{{ __('Contraseña') }}</strong>
                                </label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password-confirm" class="col-form-label text-md-right">
                                    <strong>{{__('Confirmar Contraseña') }}</strong>
                                </label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-outline-primary btn-block title">
                                    <strong>{{ __('Registrar') }}</strong>
                                </button>
                            </div>
                        </form>  
                    </div>
                    <div class="col-md-8 my-3">
                        
                        <h4 class="title"><strong>Listado de Usuarios</strong></h4>
                        <hr class="border-red">
                        @if(session('message'))
                        <div class="alert alert-{{ session('status') }}">
                            <strong>{{ session('message') }}</strong>   
                        </div>  
                        @endif 
                        <div class="table-responsive" id="resultado">
                            <table class="table">
                                <thead>
                                    <th>Nombre</th>
                                    <th>Oficina</th>
                                    <th>Tramite</th>
                                    <th>Acciones</th>
                                </thead>
                                <tbody id="tbody">
                                    @foreach($users as $user)
                                    <tr>
                                        <td>{{$user->surname}} {{$user->name}}</td>
                                        @if($user->oficina_id == 0)
                                        <td>TODAS</td>
                                        @else
                                        <td>{{$user->oficina->denominacion}}</td>
                                        @endif
                                        @if($user->tramite_id == 0)
                                        <td>TODOS</td>
                                        @else
                                        <td>{{$user->tramite->denominacion}}</td>
                                        @endif
                                        <td>
                                            <a href="{{route('user.editar', [$user->id])}}" class="btn btn-outline-primary" title="Editar Usuario" ><i class="fas fa-edit"></i></a>
                                            <a href="{{route('user.view',[$user->id])}}" class="btn btn-outline-secondary" title="Configuracion"><i class="fas fa-cog"></i></a>
                                                
                                            <a href="#" class="btn btn-outline-danger" onclick="Borrar({{$user->id}},'{{$user->name}}','{{$user->surname}}')" data-toggle="modal" data-target="#confirm" title="Eliminar Usuario"><i class="fas fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>    
            </div>
            
        </div>
    </div>
</div>
 

<div style="display: none;">
    <form action="{{route('config.search')}}" id="form-search" method="POST">
        @csrf
        <input type="hidden" name="id" id="id">
    </form>    
</div>

<!--Confirm-->
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="confirm">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">¿Estas seguro de realizar esta accion?</strong>?</h4>
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
        <h4 class="modal-title" id="myModalLabel">¿Desea eliminar a <strong><span id="nombre"></span></strong>?</strong>?</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <form method="POST" action="">
          @csrf
          <input type="hidden" name="id" id="user" value="">
          <input type="hidden" name="nombre" id="user_name" value="">
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
    <script src="{{ asset('js/usuarios.js') }}"></script>
@endsection