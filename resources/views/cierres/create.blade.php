@extends ('layouts.admin')
@section ('contenido')
    <div class="row">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ url('cotizaciones') }}">Cotizaciones</a>
                </li>
                <li class="breadcrumb-item active">
                    Cierre
                </li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h3>
                <u>Cierre de venta - Cotizacion N°:</u>
                <span style="color:#9f191f;">{{ $cotizacion->numCoti }}</span>
            </h3>
            @if(count($errors)>0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <hr>
            <div class="col-md-3">
                <div class="panel panel-danger">
                    <div class="panel-heading">
                        <h3 class="panel-title">Información de venta</h3>
                    </div>
                    <div class="panel-body">
                        {!!Form::open(array('url'=>'cierres','method'=>'POST','autocomplete'=>'off'))!!}
                        {{Form::token()}}
                        <input type="hidden" name="txt_codiCoti" value="{{ $cotizacion->codiCoti }}">
                        <input type="hidden" name="txt_codiCola" value="{{ Auth::user()->codiCola }}">
                        <input type="hidden" name="txt_codiCosteo" value="{{ $costeo->codiCosteo }}">
                        <div class="form-group">
                            <label for="">Tipo de documento</label>
                            <select name="cmb_tipoComproPago" id="cmb_tipoComproPago" class="form-control">
                                @foreach($tipoComproPago as $tcp)
                                    <option value="{{$tcp->codiTipoComproPago}}">{{ $tcp->nombreTipoComproPago }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">N° Documento</label>
                            <input name="txt_numDoc" type="text" class="form-control" value="">
                        </div>
                        <div class="form-group">
                            <label for="">Monto total de venta</label>
                            <input name="txt_montoTotal" type="text" class="form-control" value="">
                        </div>
                        <div class="form-group">
                            <label for="">Utilidad total</label>
                            <input name="txt_utilidadTotal" type="text" class="form-control" value="">
                        </div>
                        <div class="form-group">
                            <label for="">Margen total</label>
                            <input name="txt_margenTotal" type="text" class="form-control" value="">
                        </div>
                        <div class="form-group">
                            <label for="">Estado de comprobante</label>
                            <select name="cmb_estaComproPago" id="cmb_estaComproPago" class="form-control">
                                @foreach($estadosComprobante as $ec)
                                    <option value="{{$ec->codiEstaComproPago}}">{{ $ec->nombreEstaPago }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <a href="#modal-cierre"
                               data-target="#modal-cierre" data-toggle="modal" class="btn btn-danger pull-right"><i
                                        class="fa fa-save"></i> Guardar

                            </a>
                            <div class="modal fade modal-slide-in-right" aria-hidden="true"
                                 role="dialog" tabindex="-1" id="modal-cierre">

                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                <span aria-hidden="true">x</span>
                                            </button>
                                            <h4 class="modal-title">Cerrar
                                                Cotización {{$cotizacion->numCoti}}</h4>
                                        </div>
                                        <div class="modal-body">
                                            <center>¿CONFIRMAR FACTURACION?
                                            </center>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger"
                                                    data-dismiss="modal">Cerrar
                                            </button>
                                            <button type="submit" class="btn btn-success">
                                                Confirmar
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{--<a href="{{redirect('cotizaciones')}}">--}}
                                {{--<button class="btn btn-danger pull-right">Cancelar</button>--}}
                            {{--</a>--}}

                        </div>
                        {!!Form::close()!!}
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">COTIZACION N° - <label>{{$cotizacion->numCoti}}</label> - {{$cotizacion->fechaCoti}}</h3>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="">Cliente</label>
                            <input type="text" class="form-control" value="{{$cotizacion->nomCli}}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Asunto</label>
                            <input type="text" class="form-control" value="{{$cotizacion->asuntoCoti}}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Total</label>
                            <input type="text" class="form-control" value="" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Utilidad</label>
                            <input type="text" class="form-control" value="" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Margen</label>
                            <input type="text" class="form-control" value="" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Creado por</label>
                            <input type="text" class="form-control" value="{{$colaborador->name}}" readonly>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Mercadería | Servicio | Proyecto</h3>
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped table-hover ">
                            <thead>
                            <tr>
                                <th>Cantidad</th>
                                <th>Producto</th>
                                <th>Precio</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($costeoItem as $ci)
                                <tr class="warning">
                                    <td>{{ $ci->cantiCoti }}</td>
                                    <td>{{ $ci->itemCosteo }}</td>
                                    <td>{{ $ci->precioTotal }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection