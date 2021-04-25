@extends('layouts.app1')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header grey border-buton border-secondary text-white">
                    <h4 class="title"><strong>{{ __('Actualizar Usuario') }}</strong></h4>
                </div>

                <div class="card-body">
                    <input type="hidden" name="oficina_id" value="{{$user->oficina_id}}}">
                    <input type="hidden" name="tramite_id" value="{{$user->tramite_id}}}">
                    <form method="POST" action="{{ route('user.update') }}">
                        @csrf
                        <input type="hidden" name="id" value="{{$user->id}}">
                        <div class="form-group">
                            <label for="name" class="col-form-label text-md-right">
                                <strong>{{ __('Nombre:') }}</strong>
                            </label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$user->name}}" required autocomplete="name" autofocus>

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
                            <input id="surname" type="text" class="form-control @error('surname') is-invalid @enderror" name="surname" value="{{$user->surname}}" required autocomplete="surname" autofocus>

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
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{$user->email}}" required autocomplete="email">
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
                            <button type="submit" class="btn btn-outline-success btn-block title btn-lg">
                                <strong>{{ __('Actualizar Usuario') }}</strong>
                            </button>
                        </div>
                    </form>
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

@endsection
@section('script')
    <script type="text/javascript" src="{{asset('js/usuarios.js')}}"></script>
@endsection
