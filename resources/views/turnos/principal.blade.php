@extends('layouts.app')

@section('content')

    <div class="container" style="background-color: #FFFFFF;">
        <div class="row">
                        <div class="col-md-9 my-5">
                            <div class="d-block d-sm-block d-md-none text-center">
                                <img src="{{asset('images/dni.jpeg')}}" width="250px;">
                            </div>
                            <h1 class="display-3 text-center text-primary" style="font-family: 'Patua One', cursive;"><strong id="title">Bienvenido/a</strong></h1>
                            <h4 class="text-center">
                                A la Oficina Internet del Registro Civil de la Ciudad de La Rioja. Por este medio, Ud. podrá solicitar copias de actas de Nacimiento, Matrimonio y Defunción inscriptas en el Registro Civil de La Rioja Capital.
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
                        <div class="col-md-3 my-md-5">
                            <div class="d-none d-sm-none d-md-block">
                                <img src="{{asset('images/dni.jpeg')}}" width="250px;">
                            </div>
                            <div class="card border border-primary my-3">
                                <div class="card-header bg-primary">
                                    <h3 class="text-white"><i class="far fa-calendar-alt"></i> Turnos Online</h3>
                                </div>
                                <div class="card-body">
                                    <h5>Acceda al opcion Turno para obtener su turno</h5>
                                    <br>
                                    <a href="{{route('turno.index')}}" class="btn btn-outline-primary btn-block"><h4><strong>Solicitar Turno</strong></h4></a>
                                </div>
                            </div>  
                            <hr>
                            <h4>Requisitos para Trámites</h4>
                            <div class="list-group">
                                <a href="#" class="list-group-item list-group-item-action list-group-item-primary text-dark">
                                    <i class="fas fa-plus"></i> Inscripcion de Nacimiento
                                </a>
                                <a href="#" class="list-group-item list-group-item-action list-group-item-primary text-dark">
                                    <i class="fas fa-plus"></i> Renovacion de DNI
                                </a>
                                <a href="#" class="list-group-item list-group-item-action list-group-item-primary text-dark">
                                   <i class="fas fa-plus"></i> Solicitud de Actas
                                </a>
                                <a href="#" class="list-group-item list-group-item-action list-group-item-primary text-dark">
                                    <i class="fas fa-plus"></i> Inscripcion Judicial
                                </a>
                                <a href="#" class="list-group-item list-group-item-action list-group-item-primary text-dark"> 
                                    <i class="fas fa-plus"></i> Union Convivencial
                                </a>
                                <a href="#" class="list-group-item list-group-item-action list-group-item-primary text-dark">
                                    <i class="fas fa-plus"></i> Autenticaciones
                                </a>
                                <a href="#" class="list-group-item list-group-item-action list-group-item-primary text-dark">
                                    <i class="fas fa-plus"></i> Primary item
                                </a>
                                <a href="#" class="list-group-item list-group-item-action list-group-item-primary text-dark">
                                    <i class="fas fa-plus"></i> Dark item
                                </a>
                                <a href="#" class="list-group-item list-group-item-action list-group-item-primary text-dark">
                                    <i class="fas fa-plus"></i> Light item
                                </a>
                            </div>
                        </div>

        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript" src="{{asset('js/turnos.js')}}"></script>
@endsection