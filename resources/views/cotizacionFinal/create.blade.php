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
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-danger">
                    <div class="panel-heading">
                        <h3 class="panel-title">INFORMACION DE VENTA</h3>
                    </div>
                    <div class="panel-body">
                        {!!Form::open(array('url'=>'cotizacionFinal','method'=>'POST','autocomplete'=>'off'))!!}
                        {{Form::token()}}
                        <table class="table table-striped table-hover ">
                            <thead>
                            <tr class="head-table">
                                <th>FECHA DE EMISION</th>
                                <th>FECHA VENCIMIENTO</th>
                                <th>FORM DE PAGO</th>
                                <th>VENDEDOR</th>
                                <th>DOC.</th>
                                <th>N°DOCUMENTO</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="success">
                                <td><input name="txtFechaEmision" type="date" class="form-control"></td>
                                <td><input name="txtFechaVencimiento" type="date" class="form-control"></td>
                                <td>
                                    <select name="cmb_estaComproPago" id="cmb_estaComproPago" class="form-control">
                                        @foreach($estadosComprobante as $ec)
                                            <option value="{{$ec->codiEstaComproPago}}">{{ $ec->nombreEstaPago }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td><input type="text" class="form-control" value="{{$colaborador->name}}"></td>
                                <td>
                                    <select name="cmb_tipoComproPago" id="cmb_tipoComproPago" class="form-control">
                                        @foreach($tipoComproPago as $tcp)
                                            <option value="{{$tcp->codiTipoComproPago}}">{{ $tcp->nombreTipoComproPago }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td><input name="txt_numDoc" type="text" class="form-control" value="" required></td>
                            </tr>
                            </tbody>
                        </table>
                        <button type="button" class="btn btn-success btn-xs pull-right btnAdd" id="btnAdd" style="margin-bottom: 2px;">
                            <i class="fa fa-laptop"></i> <b>ADD</b>
                        </button>
                        <input type="hidden" name="txt_codiCoti" value="{{ $cotizacion->codiCoti }}">
                        <input type="hidden" name="txt_codiCola" value="{{ Auth::user()->codiCola }}">
                        <input type="hidden" name="txt_codiCosteo" value="{{ $costeo->codiCosteo }}">
                        <input name="txt_montoTotalCoti" type="hidden" value="{{ $costeo->costoTotalSoles }}">

                        <table class="table table-striped table-hover ">
                            <thead>
                            <tr class="head-table">
                                <th width="8%">CÓDIGO</th>
                                <th width="50%">DESCRIPCIÓN</th>
                                <th width="8%">CANT</th>
                                <th width="8%">P.UNITARIO</th>
                                <th width="8%">DCTOS</th>
                                <th width="13%">VALOR TOTAL</th>
                                <th width="5%"></th>
                            </tr>
                            </thead>
                            <tbody>
                            <input type="hidden" name="txtNumProds" value="{{ count($costeoItem) }}">
                            @foreach($costeoItem as $ci)
                                <tr class="warning">
                                    <td><input name="txtCodInterno{{ $ci->numPack }}" type="text" class="form-control"
                                               required></td>
                                    <td><input name="txtItem{{ $ci->numPack }}" type="text" class="form-control"
                                               value="{{ $ci->itemCosteo }}"></td>
                                    <td><input name="txtCantidad{{ $ci->numPack }}" type="text" class="form-control"
                                               value="{{ $ci->cantiCoti }}" required></td>
                                    <td><input name="txtPrecUnit{{ $ci->numPack }}" type="text" class="form-control"
                                               required></td>
                                    <td><input name="txtDcto{{ $ci->numPack }}" type="text" class="form-control"
                                               value="0"></td>
                                    <td><input name="txtValTotal{{ $ci->numPack }}" type="text" class="form-control"
                                               value="{{ $ci->precioTotal }}"></td>
                                    <td>
                                        <button id="btnDel" type="button" style="margin-top: 10%;"
                                                class="btn btn-danger btn-xs btnDel">
                                            <i class="fa fa-close"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                            <tr class="danger rowProd">
                                <td colspan="4"></td>
                                <td style="text-align: center;"><b>TOTAL</b></td>
                                <td><input name="txt_montoTotal" type="text" class="form-control" value=""></td>
                                <td>&nbsp;</td>
                            </tr>
                            </tbody>
                        </table>
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
                                                    data-dismiss="modal">Cancelar
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
        </div>
    </div>

    <script>
        $(document).ready(function(){
            $('.btnDel').on('click', function(){
                console.log("ELIMINAR EL PRODUCTO");
                $(this).closest('tr').remove();
            });

            $('.btnAdd').on('click', function(){
                var numProds = parseInt($('input[name=txtNumProds]').val()) + 1;
                console.log("TOTAL PRODUCTOS: "+numProds);
                var row = "<tr class='warning'>";
                row += "<td><input name='txtCodInterno"+numProds+"' type='text' class='form-control'";
                row += "required></td>";
                row += "<td><input name='txtItem"+numProds+"' type='text' class='form-control'";
                row += "value=''></td>";
                row += "<td><input name='txtCantidad"+numProds+"' type='text' class='form-control'";
                row += "value='1' required></td>";
                row += "<td><input name='txtPrecUnit"+numProds+"' type='text' class='form-control'";
                row += "required></td>";
                row += "<td><input name='txtDcto"+numProds+"' type='text' class='form-control'";
                row += "value='0'></td>";
                row += "<td><input name='txtValTotal"+numProds+"' type='text' class='form-control'";
                row += "value='0'></td>";
                row += "<td>";
                row += "<button id='btnDel' type='button' style='margin-top: 10%;' class='btn btn-danger btn-xs btnDel' onclick='mensaje()'>";
                row += "<i class='fa fa-close'></i></button>";
                row += "</td>";
                row += "</tr>";
                $('.rowProd').before(row);
                $('input[name=txtNumProds]').val(numProds);
            });
        });

        function mensaje(){
            $(document).on('click', '.btnDel',function(){
//                var numProds = parseInt($('input[name=txtNumProds]').val()) - 1;
                console.log("ELIMINAR EL PRODUCTO");
                $(this).closest('tr').remove();
//                $('input[name=txtNumProds]').val(numProds);
            });
        }

//        function ordenar(){
//            var numProds = parseInt($('input[name=txtNumProds]').val());
//            $('#resetPrompt').click(function(){
//                $('#input1').attr('name', 'other_amount');
//            });
//            var i = 1;
//            $('.btnDel').each(function(){
//                $('#input1').attr('name', 'other_amount');
//                console.log("numProds "+numProds);
//            });
//        }
    </script>
@endsection