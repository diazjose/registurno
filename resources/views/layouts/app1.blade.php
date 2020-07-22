<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/logo.jpeg') }}" />

        <title>DGPJ - Turnos</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Patua+One&display=swap" rel="stylesheet"> 
        <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet"> 
        
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/style1.css') }}" rel="stylesheet">
        
    </head>
    <body>
        <div class="container-fluid my-2">
            <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm" style="font-family: 'Patua One', cursive;">
                <div class="container">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <!--
                        <img src="{{asset('images/logo_gobierno_horizontal.png')}}" id="title-img"  width="200px;" style="background-color: #FF0000;">
                        <h4 class="text-white text-center" style="background-color: #FF0000;" id="sub">Secretaría de Justicia</h4>
                    -->
                      <img src="{{asset('images/secretaria_justicia.png')}}" id="title-img"  width="250px;">
                    </a>
                    <div class="text-center">
                        <h1 class="display-4 mx-md-3 text-white" id="title-head" style="font-family: 'Bebas Neue', cursive;"> DGPJ - Turnos</h1>
                    </div>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    
                    <div class="collapse navbar-collapse text-primary" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto">

                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                            <!-- Authentication Links -->
                            @guest
                            <li class="nav-item">
                                <a class="nav-link text-white" href="{{ url('/') }}">
                                    <h5><i class="fas fa-home"></i> Inicio</h5>
                                </a>
                            </li>
                            <li class="nav-item">
                                    <a class="nav-link text-white" href="{{ route('turno.search') }}">
                                        <h5><i class="fas fa-search"></i> Turnos</h5>
                                    </a>
                                </li>
                            @else
                                @switch(Auth::user()->role)
                                    @case('ADMIN')
                                        <li class="nav-item">
                                            <a class="nav-link text-white" href="{{ route('oficina.index') }}">
                                                <h5><i class="far fa-building"></i> Oficinas</h5>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link text-white" href="{{ route('tramite.index') }}">
                                                <h5><i class="fas fa-folder-minus"></i> Tramites</h5>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link text-white" href="{{ route('turno.view') }}">
                                                <h5><i class="far fa-calendar-alt"></i> Turnos</h5>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link text-white" href="{{ route('user.index') }}">
                                                <h5><i class="fas fa-users"></i> Usuarios</h5>
                                            </a>
                                        </li>
                                        @break
                                    @case('USER')
                                        <li class="nav-item">
                                            <a class="nav-link text-white" href="{{ route('turno.view') }}">
                                                <h5><i class="far fa-calendar-alt"></i> Turnos</h5>
                                            </a>
                                        </li>
                                        @break    
                                @endswitch
                                
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        <strong>{{ Auth::user()->name }} {{ Auth::user()->surname }}</strong> <span class="caret"></span>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                            <strong>{{ __('Cerrar Sesión') }}</strong>
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>

            <div class="container-fluid my-5">
                @yield('content')
            </div>
            @yield('script')
            
        </div>
    </body>        
</html>    