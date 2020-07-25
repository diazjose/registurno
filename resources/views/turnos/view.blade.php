@extends('layouts.app1')

@section('content')
<div class="container-fliud">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card border-danger">
                <div class="card-header grey border-buton border-danger">
                    <h3 class="text-white"><strong>Turnos - @if($fecha != '') {{date('d/m/Y', strtotime($fecha))}} @else {{date('d/m/Y')}} @endif</strong></h3>
                 </div>

                <div class="card-body">                    
                    <div class="col-md-10 my-3">
                        <h4>Buscar Turnos por Fecha</h4>
                        <form class="form-inline" method="POST">
                            @csrf
                            <div class="form-group">
                                <input type="date" class="form-control" id="fecha" name="fecha">
                            </div>
                            <div class="form-group">
                                <a href="#" id="fechaTurno" class="mx-md-2 btn btn-primary btn-md-block"><strong><i class="fas fa-search"></i> Buscar</strong></a>
                            </div>
                        </form>    
                    </div>
                    <hr class="border border-danger">
                    
                    <!--<div class="row">-->
                        @if($viene == 1 )
                        @foreach($oficina as $ofi)
                        <div class="text-center">
                            <h4 class="title text-center">{{$ofi->denominacion}}</h4>
                            <table class="table">
                                <thead>
                                    <th>Turno</th>
                                    <th>Orden</th>
                                    <th>Tipo</th>
                                    <th>Entidad</th>
                                    <th>Hora</th>
                                    <th>Estado</th>
                                </thead>
                                <tbody>
                                    @foreach($turnos[$ofi->denominacion] as $turno)
                                    <tr id="{{$turno->id}}">
                                        <td class="turno">{{$turno->dni}}</td>
                                        <td class="orden">{{$turno->orden}}°</td>
                                        <td>{{$turno->tramite->denominacion}}</td>
                                        <td>{{$turno->ente}}</td>
                                        <td class="hora">{{$turno->hora}}</td>
                                        <td class="estado">
                                            @switch($turno->estado)
                                                @case('Atendido')
                                                    <a href="#" onclick="btnAtendido('{{$turno->id}}', 'Espera')" class="btn btn-success"><strong>{{$turno->estado}}</strong></a>
                                                    @break
                                                @case('Espera')
                                                    <a href="#" onclick="btnAtendido('{{$turno->id}}', 'Llamado')" class="btn btn-danger"><strong> {{$turno->estado}}...</strong></a>
                                                    @break
                                                @case('Llamado')
                                                    <a href="#" onclick="btnAtendido('{{$turno->id}}', 'Atendido')" class="btn btn-warning"><strong>{{$turno->estado}}</strong></a>
                                                    @break                                               
                                            @endswitch
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @endforeach
                        @else    
                            <div class="col-md-8">
                                <h4>{{$oficina->denominacion}}</h4>
                                <table class="table">
                                    <thead>
                                        <th>Turno</th>
                                        <th>Orden</th>
                                        <th>Tipo</th>
                                        <th>Ente</th>
                                        <th>Hora</th>
                                        <th>Estado</th>
                                    </thead>
                                    <tbody>
                                        @foreach($turnos[$oficina->denominacion] as $turno)
                                        <tr id="{{$turno->id}}">
                                            <td class="turno">{{$turno->dni}}</td>
                                            <td class="orden">{{$turno->orden}}°</td>
                                            <td>{{$turno->tramite->denominacion}}</td>
                                            <td>{{$turno->ente}}</td>
                                            <td class="hora">{{$turno->hora}}</td>
                                            <td class="estado">
                                                @switch($turno->estado)
                                                    @case('Atendido')
                                                        <a href="#" onclick="btnAtendido('{{$turno->id}}', 'Espera')" class="btn btn-success"><strong>{{$turno->estado}}</strong></a>
                                                        @break
                                                    @case('Espera')
                                                        <a href="#" onclick="btnAtendido('{{$turno->id}}', 'Llamado')" class="btn btn-danger"><strong> {{$turno->estado}}...</strong></a>
                                                        @break
                                                    @case('Llamado')
                                                        <a href="#" onclick="btnAtendido('{{$turno->id}}', 'Atendido')" class="btn btn-warning"><strong>{{$turno->estado}}</strong></a>
                                                        @break                                               
                                                @endswitch
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif                    
                    <!--</div>-->                   
                    <div style="display: none;">
                        <form action="{{route('turno.status')}}" id="form-turno" method="POST">
                            @csrf
                            <input type="text" name="turno" id="turno">
                            <input type="text" name="estado" id="estado">
                        </form>    
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
    <script type="text/javascript" src="{{asset('js/turnos.js')}}"></script>
@endsection
