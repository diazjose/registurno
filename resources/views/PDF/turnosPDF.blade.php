<!DOCTYPE html>
<html>
	<head>
		<title>Turno</title>
		<style type="text/css">
			.mx{
				margin: 10px;
			}
			p{
				font-size: 14px;
			}
			small{
				font-weight: normal;
				margin-left: 10px;
			}
		</style>
		<link href="{{public_path('css/pdf.css') }}" rel="stylesheet" type="text/css" />
	</head>
	<body>
		<header>
            <img src="{{ asset('images/logo_gob/HEADER -SÓLIDO.png') }}" width="100%">
			<!--
            <div class="container">
	            <div class="left">
	                <img src="{{ asset('images/secretaria_justicia.png') }}" id="logo">
	            </div>
	            <div class="text-center">
	       	 	    <div class="text-white" id="title-header">
	                        <span><strong>Dirección General de Personas Jurídicas</strong></span>
	                    </div>
                        <!--
		                <div class="text-white" id="sub">
		                    <span>Secretaria de Justicia</span>
		                </div>
                    -->
	                <!--
                    </div>
	        </div>
            -->
        </header>
        <div class="text-center table-responsive">
            <h4 class="title text-center">Turnos del Dia {{date('d/m/Y', strtotime($fecha))}}</h4>
            <table class="table">
                <thead class="thead-light">
	                <tr>
		                <th>Orden</th>
	                    <th>N° Turno</th>
	                    <th>Teléfono</th>
	                    <th>Trámite</th>
	                    <th>Entidad</th>
	                    <th>Hora</th>
	                </tr>
	            </thead>
                <tbody>
          	        @foreach($turnos as $turno)
                    <tr>
                        <td>{{$turno->orden}}°</td>
                        <td>{{$turno->dni}}</td>
                        <td>{{$turno->telefono}}</td>
                        <td>{{$turno->tramite->denominacion}}</td>
                        <td>{{$turno->ente}}</td>
                        <td>{{$turno->hora}}</td>
               		</tr>		
                    @endforeach
                </tbody>
            </table>
        </div>
    </body>
</html>