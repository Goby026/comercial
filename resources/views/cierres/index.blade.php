@extends ('layouts.admin')
@section ('contenido')
    <div class="row">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ url('cotizaciones') }}">Cotizaciones</a>
                </li>
                <li class="breadcrumb-item active">
                    Cierres
                </li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="page-header">
            <h1 style="margin-left: 20px;">
                Cotizaciones cerradas
            </h1>
        </div>
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
            {{--<h3>Igv<a href="igv/create"><button class="btn btn-success pull-right">Nuevo</button></a> </h3>--}}
            {{--@include('igv.search')--}}
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-condensed table-hover">
                    <thead>
                    <th>Cotización</th>
                    <th>Creado por</th>
                    <th>Fecha cotización</th>
                    <th>Documento</th>
                    <th>Nro</th>
                    <th>Estado Documento</th>
                    <th>Total</th>
                    <th>Margen</th>
                    </thead>
                    <tbody>
                    @foreach($cotisFinal as $cf)
                        <tr>
                            <td>{{ $cf->numCoti }}</td>
                            <td>{{ $cf->nombreCola }} {{ $cf->apePaterCola }} {{ $cf->apeMaterCola }}</td>
                            <td>{{ $cf->fechaCoti }}</td>
                            <td>{{ $cf->nombreTipoComproPago }}</td>
                            <td>{{ $cf->numeComproPago }}</td>
                            <td>{{ $cf->nombreEstaPago }}</td>
                            <td>{{ $cf->montoTotalFactuSIGV }}</td>
                            <td>{{ $cf->margenFinal }}</td>

                            <td>
                                @if($cf->estado == 1)
                                    <a href="{{URL::action('CierreController@edit',$cf->codiCotiFinal)}}">
                                        <button class="btn btn-warning  btn-xs">Continuar</button>
                                    </a>
                                @endif
                                    <a id="modal-163489" href="#modal-container-{{$cf->numCoti}}" role="button"
                                       class="btn btn-danger btn-xs"
                                       data-toggle="modal">Gastos</a>
                                    <div class="modal fade" id="modal-container-{{$cf->numCoti}}" role="dialog"
                                         aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header"
                                                     style="background-color: #9f191f; color: #FDFDFD;">
                                                    <h4 class="modal-title" id="myModalLabel">
                                                        <b>GESTION DE GASTOS</b>
                                                        <button type="button" class="close" data-dismiss="modal">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </h4>
                                                    <hr>
                                                    <em>
                                                        <small><u>COTIZACION: {{$cf->numCoti}}</u> -</small>
                                                        FACTURA: <u>{{$cf->numeComproPago}}</u></em>
                                                </div>
                                                <form class="form-horizontal" action="storeGastoCierre" method="POST">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <div class="modal-body">
                                                        <input type="hidden" name="txtCodiCotiFinal" value="{{$cf->codiCotiFinal}}">
                                                        <div class="form-group">
                                                            <label for="txtFecha"
                                                                   class="col-lg-2 control-label">FECHA</label>
                                                            <div class="col-lg-10">
                                                                <input type="date" class="form-control" id="txtFecha" name="txtFecha">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="txtTipoGasto"
                                                                   class="col-lg-2 control-label">TIPO DE GASTO</label>
                                                            <div class="col-lg-10">
                                                                <select class="form-control" id="txtTipoGasto"
                                                                        name="txtTipoGasto">
                                                                    @foreach($tipoGastos as $tipoGasto)
                                                                        <option value="{{$tipoGasto->codiTipoGasto}}">{{$tipoGasto->nombreTipoGasto}}</option>
                                                                    @endforeach

                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="txtColaGasto"
                                                                   class="col-lg-2 control-label">COLABORADOR</label>
                                                            <div class="col-lg-10">
                                                                <select id="txtColaGasto"
                                                                        name="txtColaGasto"
                                                                        class="form-control selectpicker"
                                                                        data-live-search="true">
                                                                    @foreach($colaboradores as $colaborador)
                                                                        <option value="{{$colaborador->codiCola}}">{{$colaborador->nombreCola}} {{$colaborador->apePaterCola}} {{$colaborador->apeMaterCola}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="txtMonto"
                                                                   class="col-lg-2 control-label">MONTO</label>
                                                            <div class="col-lg-10">
                                                                <input type="text" class="form-control" id="txtMonto" name="txtMonto">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="txtEstadoGasto"
                                                                   class="col-lg-2 control-label">ESTADO DE GASTO</label>
                                                            <div class="col-lg-10">
                                                                <select class="form-control" id="txtEstadoGasto" name="txtEstadoGasto">
                                                                    <option value="">1</option>
                                                                    <option value="">2</option>
                                                                    <option value="">3</option>
                                                                    <option value="">4</option>
                                                                    <option value="">5</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="modal-footer">

                                                        <button type="button" class="btn btn-danger"
                                                                data-dismiss="modal">
                                                            Cancelar
                                                        </button>
                                                        <button type="submit" class="btn btn-success" id="btn_addGastos">
                                                            Registrar Gastos
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>

                                        </div>

                                    </div>
                                <button class="btn btn-primary btn-xs"><i class="fa fa-book"></i> Reporte</button>
                            </td>
                        </tr>
                        {{--@include('igv.modal') <!-- incluimos el archivo del modal -->--}}
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- paginacion -->
        {{--{{$igv->render()}}--}}
        <!-- fin paginacion -->

        </div>
    </div>

    <script>

    </script>
@endsection