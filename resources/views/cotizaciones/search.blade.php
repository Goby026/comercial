@extends ('layouts.admin')
@section ('contenido')
    <div class="row">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ url('cotizaciones') }}">Cotizaciones</a>
                </li>
                <li class="breadcrumb-item active">
                    Búsqueda
                </li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-md-12">

            @if(count($errors)>0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="page-header">
                <h1>
                    Resultados de busqueda
                    <small>parámetro: <b>{{$respuesta}}</b></small>
                </h1>
            </div>
            <table class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th width="400">
                        ASUNTO
                    </th>
                    <th width="200">
                        CLIENTE
                    </th>
                    <th width="150">
                        FECHA / HORA
                    </th>
                    <th>
                        CREADO POR
                    </th>
                    <th>
                        ESTADO
                    </th>
                    <th>
                        TOTAL
                    </th>
                    <th colspan="3">
                        <center>ACCIONES</center>
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($cotizaciones as $coti)
                    <tr class="active">
                        <td style="background-color: #0d6aad; color: #FDFDFD; text-align: center;">
                            {{ $coti->numCoti }}
                        </td>
                        <td>
                            {!! $coti->asuntoCoti !!}
                        </td>
                        {{--@if( $coti->codiClienNatu != '001' )--}}
                        {{--<td>{{ $coti->apePaterClienN }} {{ $coti->apeMaterClienN }} {{ $coti->nombreClienNatu }}--}}
                        {{--</td>--}}
                        {{--@else--}}
                        {{--<td>{{ $coti->razonSocialClienJ }}</td>--}}
                        {{--@endif--}}
                        <td>
                            {{ $coti->nomCli }}
                        </td>
                        <td>
                            {{ $coti->fechaSistema }}
                        </td>
                        <td>
                            {{ $coti->nombreCola }} {{ $coti->apePaterCola }} {{ $coti->apeMaterCola }}
                        </td>
                        <td>
                            {{ $coti->nombreCotiEsta }}
                        </td>
                        <td>
                            S/. {{ $coti->totalVentaSoles }}
                        </td>
                        <td style="text-align: center">
                            <a href="{{ url('cotizacion',['codiCoti'=>$coti->codiCoti]) }}"
                               class="btn btn-default btn-xs"><i class="fa fa-eye"></i> costeo </a>
                            <a href="{{ url('pdfCoti',['codiCoti'=>$coti->codiCoti]) }}" target="_blank"
                               class="btn btn-primary btn-xs"><i class="fa fa-eye"></i> cotización </a>
                            @if( $coti->estaCotiEsta == 20 )
                                <a href="#">
                                    <button class="btn btn-warning btn-xs"><i class="fa fa-forward"></i> Incompleta</button>
                                </a>
                            @else
                                <a href="#modal-reutilizar{{$coti->codiCoti}}"
                                   data-target="#modal-reutilizar{{$coti->codiCoti}}" data-toggle="modal">
                                    <button id="btn_reutilizar" type="button" class="btn btn-success btn-xs"><i
                                                class="fa fa-history"></i> Reutilizar
                                    </button>
                                </a>

                                <form action="{{ url('/cotizaciones/reutilizar') }}" method="POST">
                                    {{Form::token()}}
                                    <input name="txt_codiCoti" type="hidden" value="{{$coti->codiCoti}}">
                                    <div class="modal fade modal-slide-in-right" aria-hidden="true"
                                         role="dialog" tabindex="-1" id="modal-reutilizar{{$coti->codiCoti}}">

                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">x</span>
                                                    </button>
                                                    <h4 class="modal-title">Reutilizar
                                                        Cotización {{$coti->numCoti}}</h4>
                                                    <input type="hidden" name="txt_codiCola"
                                                           value="{{ Auth::user()->codiCola }}">
                                                </div>
                                                <div class="modal-body">
                                                    <center>Al reutilizar iniciará una nueva cotización con
                                                        los datos cargados de la cotización seleccionada, el
                                                        temporizador comenzará a correr.
                                                    </center>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger"
                                                            data-dismiss="modal">Cerrar
                                                    </button>
                                                    <button type="submit" class="btn btn-success">
                                                        Continuar
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection