@extends('layouts.app1')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4><strong>{{ __('Registrar Usuario') }}</strong></h4>
                </div>

                <div class="card-body">
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
                            <input id="surname" type="text" class="form-control @error('surname') is-invalid @enderror" name="name" value="{{ old('surname') }}" required autocomplete="surname" autofocus>

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
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    <strong>{{ __('Registrar') }}</strong>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
