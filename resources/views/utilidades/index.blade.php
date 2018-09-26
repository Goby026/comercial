@extends ('layouts.admin')
@section ('contenido')
    <style>
        .controles{
            /*background-color: #FFC414;*/
            margin: 0 auto;
            width: 40%;
        }
    </style>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ url('cotizaciones') }}">Cotizaciones</a>
            </li>
            <li class="breadcrumb-item active">
                Reportes de Utilidad
            </li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h1>
                    Reportes de utilidad
                    {{--<small>buscador por fechas</small>--}}
                    <small>buscador</small>
                </h1>
            </div>
            <div class="controles">
                <form action="{{ url('getUtilidades') }}" role="form" method="POST" class="form-inline">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    {{--<div class="form-group">--}}
                        {{--<label for="txtFechaInicio">--}}
                            {{--Fecha inicial--}}
                        {{--</label><br>--}}
                        {{--<input type="date" class="form-control" id="txtFechaInicio" name="txtFechaInicio" required/>--}}
                    {{--</div>--}}
                    {{--<div class="form-group">--}}
                        {{--<label for="txtFechaFinal">--}}
                            {{--Fecha final--}}
                        {{--</label><br>--}}
                        {{--<input type="date" class="form-control" id="txtFechaFinal" name="txtFechaFinal" required/>--}}
                        {{--<button type="submit" class="btn btn-success pull-right" style="margin-left: 2px;">--}}
                            {{--Mostrar--}}
                        {{--</button>--}}
                    {{--</div>--}}

                    <div class="form-group">
                        <label for="txtCola">
                            Colaborador
                        </label><br>
                        <select name="txtCola" id="txtCola" class="form-control">
                            {{--@if(isset($utilidades))--}}
                                {{--@foreach($usuarios as $user)--}}
                                    {{--@if($user->codiCola == $utilidades->codiCola)--}}
                                        {{--<option value="{{ $user->codiCola }}" selected>{{  $user->name }}</option>--}}
                                    {{--@endif--}}
                                {{--@endforeach--}}
                            {{--@else--}}
                                {{----}}
                            {{--@endif--}}
                            @foreach($usuarios as $user)
                                <option value="{{ $user->codiCola }}">{{  $user->name }}</option>
                            @endforeach

                        </select>
                        {{--<input type="date" class="form-control" id="txtCola" name="txtCola" required/>--}}
                        <button type="submit" class="btn btn-success pull-right" style="margin-left: 2px;">
                            Mostrar
                        </button>
                    </div>
                </form>
            </div>
            <br>
        </div>
        <div class="col-md-12">
            <table class="table table-bordered table-hover table-sm">
                <thead>
                <tr>
                    <th>
                        Total cotizaciones
                    </th>
                    <th>
                        Total Facturados
                    </th>
                    <th>
                        Monto Facturado
                    </th>
                    <th>
                        Costo sin IGV
                    </th>
                    <th>
                        Margen
                    </th>
                    <th>
                        Utilidad
                    </th>
                </tr>
                </thead>
                <tbody>
                @if(isset($utilidades))
                    @foreach($utilidades as $uti)
                        <tr class="table-success">
                            <td>
                                {{ $uti->Cotizaciones  }}
                            </td>
                            <td>
                                {{ $uti->Cerradas  }}
                            </td>
                            <td>
                                {{ $uti->MontoVenta  }}
                            </td>
                            <td>
                                {{ $uti->Costo  }}
                            </td>
                            <td>
                                {{ $uti->Margen  }}
                            </td>
                            <td>
                                {{ $uti->Utilidad  }}
                            </td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection