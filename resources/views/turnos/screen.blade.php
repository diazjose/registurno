@extends('layouts.app1')

@section('content')
<div class="container-fliud">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card border-secondary">
                <div class="card-header grey border-buton border-secondary">
                    <h3 class="text-white title"><strong>Turnos </strong></h3>
                 </div>

                <div class="card-body">                    
                   <h3> 
                        <table class="table">
                          <thead>
                            <tr>
                              <th scope="col">#</th>
                              <th scope="col">turnos</th>
                              <th scope="col"> BOX</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($turnos as $tur)
                            <tr>
                              <th scope="row">1</th>
                              <td>{{$tur->dni}}</td>
                              <td>4</td>
                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                    </h3>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
    <script type="text/javascript" src="{{asset('js/turnos.js')}}"></script>
@endsection
