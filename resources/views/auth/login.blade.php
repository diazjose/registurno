@extends('layouts.app1')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card border-red">
                <div class="card-header color-red title"><h4><strong>{{ __('Iniciar Sesión') }}</strong></h4></div>

                <div class="card-body grey-turno">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group">
                            <label for="email" class="col-form-label text-md-right title">
                                <strong>{{ __('Correo Electrónico') }}</strong>
                            </label>
                            <input id="email" type="email" class="form-control form-control-lg @error('email') is-invalid @enderror border-dark" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-form-label text-md-right title">
                                <strong>{{ __('Contraseña') }}</strong>
                            </label>
                            <input id="password" type="password" class="form-control form-control-lg @error('password') is-invalid @enderror border-dark" name="password" required autocomplete="current-password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <hr class="border-danger">
                        <div class="form-group">
                            <button type="submit" class="btn-red border-red btn-block btn-lg">
                                {{ __('Iniciar Sesión') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
