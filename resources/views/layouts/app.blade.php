<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Registro Civil</title>

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
            <nav class="navbar navbar-expand-md navbar-light bg-primary" style="font-family: 'Patua One', cursive;">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <!--
                    <img src="{{asset('images/logo_gobierno_horizontal.png')}}" id="title-img"  width="200px;" style="background-color: #FF0000;">
                    <h4 class="text-white text-center" style="background-color: #FF0000;" id="sub">Secretaría de Justicia</h4>
                    -->
                    <img src="{{asset('images/secretaria_justicia.png')}}" id="title-img"  width="300px;" style="background-color: #FF0000;">
                    
                </a>
                <h1 class="display-3 text-white" id="title-head" style="font-family: 'Bebas Neue', cursive;"> Registro Civil</h1>
                <div class="text-center">
                    
                </div>
                <!--
                <div class="text-center">
                    <h1 class="display-3 mx-md-3 text-white" id="title-head"> Registro Civil</h1>
                </div> -->
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
                            <li class="nav-item">
                                <a class="nav-link text-white" href="{{ route('turno.search') }}">
                                    <h5><i class="fas fa-search"></i> Turnos</h5>
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <strong>{{ Auth::user()->name }} {{ Auth::user()->surname }}</strong> <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <strong>{{ __('Cerrar Sesion') }}</strong>
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
        <div class="d-none d-sm-none d-md-block">
            <div class="row">
                <div class="col-md-6">
                    <div class="alert alert-danger text-center" id="box1">
                        <div class="row text-center">
                            <img src="{{asset('images/secretaria.jpg')}}" width="92px;">
                            <div class="align-self-center">
                                <h5 id="autoridad" class="text-center">
                                    <div class="mx-md-3">    
                                        <strong>Secretaría de Justicia</strong>     
                                    </div>
                                    <div class="mx-md-3">
                                        Dra. Karina Becerra    
                                    </div>
                                 </h5>
                            </div>
                        </div>
                    </div>  
                </div>
                <div class="col-md-6">
                    <div class="alert alert-danger" id="box2">
                        <div class="row">    
                            <img src="{{asset('images/lucas2.jpg')}}" width="100px;">
                            <div class="align-self-center">
                                <h5 id="autoridad" class="text-center">
                                    <div class="mx-md-3">    
                                        <strong>Director Registro Civil</strong>      
                                    </div>
                                    <div class="mx-md-3">
                                        Dr. Lucas Casas    
                                    </div>
                                </h5>
                            </div>
                        </div>    
                    </div>  
                </div>
            </div>
        </div>
                
        <div class="d-block d-sm-block d-md-none my-2">
            <div class="col-md-6">
                <div class="alert alert-danger">
                    <div class="row text-center">
                        <img src="{{asset('images/secretaria.jpg')}}" width="70px;">
                        <div class="align-self-center">
                            <h5 id="autoridad" class="text-center mx-3">
                                <div class="mx-md-3">    
                                    <strong>Secretaría de Justicia</strong>     
                                </div>
                                <div class="mx-md-3">
                                    Dra. Karina Becerra    
                                </div>
                            </h5>
                        </div>
                    </div>
                </div>  
            </div>
            <div class="col-md-6">
                <div class="alert alert-danger">
                    <div class="row text-center">
                        <img src="{{asset('images/lucas2.jpg')}}" width="75px;">
                        <div class="align-self-center">
                            <h5 id="autoridad" class="text-center mx-3">
                                <div class="mx-md-3">    
                                    <strong>Director Registro Civil</strong>      
                                </div>
                                <div class="mx-md-3">
                                    Dr Lucas Casas    
                                </div>
                            </h5>
                        </div>
                    </div>
                </div>  
            </div>
        </div>        
                

        <main id="app" style="background-color: #FFFFFF;">
            @yield('content')
        </main>     
        
         <div class="container-fluid">
            <footer class="text-white">
                <div class="row">
                    <div class="col-md-5 text-center mt-5 mb-sm-3 border-sm-bottom borde-white">
                        <a class="navbar-brand" href="{{ url('/asdsad') }}">
                            <img src="{{asset('images/logo_gobierno_horizontal.png')}}" width="300px;" style="background-color: #FF0000;">
                            <h3 class="text-white text-center"style="background-color: #FF0000;">Secretaría de Justicia</h3>
                        </a>    
                    </div>
                    <div class="col-md-3 col-sm-12 text-center my-md-5 border-sm-bottom borde-sm-white" id="footer-div">
                        <h4 class="text-dark"><strong>Contacto</strong></h4>
                        <div class="my-1">
                            <h6><i class="fas fa-map-marker-alt"></i>  Av. Rivadavia 790.</h6>    
                        </div>
                        <div class="my-1">
                            <h6><i class="fas fa-mobile-alt"></i> 380-4963214.</h6>    
                        </div>
                        <div class="my-1">
                            <h6><i class="fas fa-envelope"></i> registrocivil@larioja.com</h6>    
                        </div> 
                    </div>
                    
                    <div class="col-md-4 text-center my-md-5 m border-sm-bottom borde-sm-white">
                        <h4  class="text-dark"><strong>Seguinos</strong></h4>
                        <div class="d-flex justify-content-center">
                            <div class="align-self-center my-2">
                                <ul class="social-network social-circle">
                                    <li><a href="#" class="icoFacebook" title="Facebook"><h1 class="my-1"><i class="fab fa-facebook"></i></h1></a></li>
                                    <li><a href="#" class="icoInstegram" title="Instegram"><h1 class="my-1"><i class="fab fa-instagram"></i></h1></a></li>
                                    <li><a href="#" class="icoLinkedin" title="Twiter"><h1 class="my-1"><i class="fab fa-twitter"></i></h1></a></li>
                                    <li><a href="#" class="icoYoutube" title="Youtube"><h1 class="my-1"><i class="fab fa-youtube"></i></h1></a></li>
                                </ul>             
                            </div>
                        </div> 
                    </div>
                </div>
                <div class="text-center text-dark my-1 d-none d-sm-none d-md-block">
                    <h6>2020 Registro Civil - La Rioja</h6>
                </div>
            </footer>
         </div>
         @yield('script')
    </body>
</html>


