<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Registro Civil La Rioja</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Patua+One&display=swap" rel="stylesheet"> 
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">


        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
        
    </head>
    <body>
        
        <div class="container-fluid my-2">
            <nav class="navbar navbar-expand-md navbar-light bg-danger" style="font-family: 'Patua One', cursive;">
                <div class="container">
                    <div class="row">
                        <div class="col-md-2 d-flex justify-content-center mx-2 my-md-2 border-right border-white">
                            <a class="navbar-brand" href="{{ url('/') }}">
                                <img src="{{asset('images/logo_gobierno.png')}}" class="logo mx-3" width="150px;">
                            </a>
                        </div>
                        <div class="col text-center my-md-3">
                            <div class="d-flex justify-content-center text-white" style="font-family: 'Bebas Neue', cursive;">
                                <h1><strong>Direccion General de Personas Juridicas</strong></h1>
                            </div>
                        </div>
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
                            <li class="nav-item">
                                <a class="nav-link text-white" href="#">
                                    <h5>Iniciar Sesión</h5>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white" href="#">
                                    <h5><i class="fas fa-search"></i> Turnos</h5>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            
                <div class="container my-5" style="background-color: #FFFFFF;">
                    <div class="row">
                        <div class="col-md-9 my-5">
                            <h1 class="display-3 text-center text-primary"><strong id="title">Bienvenido/a</strong></h1>
                            
                            <h4 class="text-center">
                                La Dirección General de Personas Jurídicas (DGPJ La Rioja), dependiente de la Secretaría de Justicia de la Provincia de La Rioja, tiene como misión principal el control de la legalidad, registración y fiscalización de la vida institucional de entidades civiles y comerciales, promoviendo así el fortalecimiento del principio de seguridad jurídica y resguardando el interés público.
                            </h4>

                            <br><hr>
                            <h4 class="text-center">
                                Los acontecimientos extraordinarios de público conocimiento y el progresivo y continuo desmejoramiento de la situación sanitaria mundial, derivada de la Pandemia COVID-19 declarada por la OMS, y lo anunciado por el Presidente de la Nación en cuanto a la continuidad de las medidas de aislamiento social, preventivo y obligatorio. Es que la Dirección de Registro Civil, dependiente de la Secretaría de Justicia, informa que ha dispuesto un esquema especial de guardias.
                            </h4>    
                            <br><hr>
                            <div class="alert alert-warning">
                              <h4><strong>¡¡ Se atiende solo con turno !!</strong></h4>
                            </div><hr>
                            
                            <h3>¿Como Solicitar Turno?</h3>
                            <br>
                            <ul class="list-group">
                              <li class="list-group-item">
                                <h5><strong>1- Completar el formulario de Solicitud de Turno</strong></h5>
                              </li>
                              <li class="list-group-item">
                                <h5><strong>2- Descargar el comprobante de Solicitud</strong></h5>
                              </li>
                              <li class="list-group-item">
                                <h5><strong>3- Concurrir con el dni del titular del turno a la oficina</strong></h5>
                              </li>
                            </ul>
                            <hr>
                            <div class="alert alert-primary">
                              <h4>
                                <strong>
                                    Una vez procesada su solicitud, se le indicará día y hora que deberá presentarse SÓLO UNA PERSONA a la oficina del Registro Civil con el DNI en mano.
                                </strong>
                              </h4>
                            </div>
                        </div>  
                        <div class="col-md-3 my-5">
                            <div class="card border border-primary">
                                <div class="card-header bg-primary">
                                    <h3 class="text-white"><i class="far fa-calendar-alt"></i> Turnos Online</h3>
                                </div>
                                <div class="card-body">
                                    <h5>Acceda al opcion Turno para obtener su turno</h5>
                                    <br>
                                    <a href="#" class="btn btn-outline-primary btn-block"><h4><strong>Solicitar Turno</strong></h4></a>
                                </div>
                            </div>
                        </div>

                    </div>

                    
                </div>
            <!--</div>-->
        </div>    
    </body>
</html>
