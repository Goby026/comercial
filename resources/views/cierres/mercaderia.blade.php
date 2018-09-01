@extends ('layouts.admin')
@section ('contenido')
    <style>
        .col-center{
            text-align: center;
        }
    </style>
    @if(count($errors)>0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="row">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ url('cotizaciones') }}">Cotizaciones</a>
                </li>
                <li class="breadcrumb-item active">
                    Mercadería
                </li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-md-2">
            Dolar: <input type="text" id="txt_dolar" name="txt_dolar" value="{{ $dolar->dolarVenta }}" class=" form-control" style="text-align: center;">
            <input type="hidden" name="txt_dolar" value="{{ $dolar->codiDolar }}">
        </div>
        <div class="col-md-2">
            IGV: <input type="text" id="txt_igv" name="txt_igv" value="{{ $igv->valorIgv/100 }}" class=" form-control" style="text-align: center;">
            <input type="hidden" name="txt_igv" value="{{ $igv->codiIgv }}">
        </div>
        <div class="col-md-8">
            {{--@if(isset($coti_continue))--}}
            {{--<br>--}}
            {{--<a href="#" class="btn btn-primary pull-right add-modal-newItem" style="width: 100%;">Agregar--}}
            {{--Producto</a>--}}
            {{--@endif--}}
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h3>
                <u>Cierre de venta -> Cotizacion N°:</u>
                <small style="color:#9f191f;">{{ $cotizacion->numCoti }}</small>
                ->{{$cotizacionFinal->codiCotiFinal}}
            </h3>

            <hr>
            <div class="panel panel-danger">
                <div class="panel-heading">
                    <h3 class="panel-title">MERCADERIA COTIZADA</h3>
                </div>
                <div class="panel-body">
                    <table class="tabla">
                        <thead class="head_costeo">
                        <tr>
                            <th style="text-align: center;" width="450">
                                DETALLE
                            </th>
                            <th style="text-align: center;" width="250">
                                PROVEEDOR
                            </th>
                            <th style="text-align: center;">
                                CAN
                            </th>
                            <th style="text-align: center;">
                                C.U $ SIN
                            </th>
                            <th style="text-align: center;">
                                C.U $
                            </th>
                            <th style="text-align: center;">
                                TOTAL
                            </th>
                            <th style="text-align: center;">
                                C.U S/
                            </th>
                            <th style="text-align: center;">
                                TOTAL
                            </th>
                            <th style="text-align: center;">
                                UTILIDAD
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($productos as $producto)
                            <tr>
                                <td width="300">
                                    @if($producto->itemCosteo != '.')
                                        <input name="txt_new_product{{ $producto->numPack }}" class="form-control"
                                               type="text" value="{{ $producto->itemCosteo }}"
                                               size="50" readonly>
                                    @else
                                        <input name="txt_new_product{{ $producto->numPack }}" class="form-control"
                                               type="text"
                                               value="{{ $producto->nombreProducProveedor }}"
                                               size="50" readonly>
                                    @endif
                                </td>
                                <td>
                                    <input type="text" class="form-control" readonly value="{{$producto->nombreProveedor}}">
                                </td>
                                <td>
                                    <input class="form-control" type="text" id="txt_cantidad{{ $producto->numPack }}"
                                           name="txt_cantidad{{ $producto->numPack }}"
                                           value="{{ $producto->cantiCoti }}"
                                           size="2" style="text-align: center;" readonly>
                                </td>
                                <td>
                                    <input class="form-control" type="text"
                                           id="txt_cus_dolar_sin{{ $producto->numPack }}"
                                           name="txt_cus_dolar_sin{{ $producto->numPack }}"
                                           value="{{ number_format($producto->precioProducDolar, 2, '.', '') }}"
                                           size="10"
                                           style="text-align: center;" readonly>
                                </td>
                                <td>
                                    <input class="form-control" type="text" id="txt_cus_dolar{{ $producto->numPack }}"
                                           name="txt_cus_dolar{{ $producto->numPack }}"
                                           value="{{ number_format($producto->costoUniIgv, 2, '.', '') }}" size="10"
                                           style="text-align: center;" readonly>
                                </td>
                                <td>
                                    <input class="form-control totalCU" type="text" id="txt_total_dolar{{ $producto->numPack }}"
                                           name="txt_total_dolar{{ $producto->numPack }}"
                                           value="{{ number_format($producto->costoTotalIgv, 2, '.', '') }}" size="10"
                                           style="text-align: center;" readonly>
                                </td>
                                <td>
                                    <input class="form-control totalCUS" type="text" id="txt_cus_soles{{ $producto->numPack }}"
                                           name="txt_cus_soles{{ $producto->numPack }}"
                                           value="{{ number_format($producto->costoUniSolesIgv, 2, '.', '') }}"
                                           size="10"
                                           style="text-align: center;" readonly>
                                </td>
                                <td>
                                    <input class="form-control totalProd" type="text" id="txt_total_soles{{ $producto->numPack }}"
                                           name="txt_total_soles{{ $producto->numPack }}"
                                           value="{{ number_format($producto->costoTotalSolesIgv, 2, '.', '') }}"
                                           size="10"
                                           style="text-align: center;" readonly>
                                </td>
                                <td>
                                    <input class="form-control totalUtiProd" type="text" id="txt_total_soles{{ $producto->numPack }}"
                                           name="txt_total_soles{{ $producto->numPack }}"
                                           value="{{ number_format($producto->utiCoti, 2, '.', '') }}"
                                           size="10"
                                           style="text-align: center;" readonly>
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="5"></td>
                            <td><input class="form-control" type="text" id="txtTotalDolarSIN" name="txtTotalDolarSIN"
                                       style="text-align: center;" value="" readonly></td>
                            <td><input class="form-control" type="text" id="txtCUSProd" name="txtCUSProd"
                                       style="text-align: center;" value="" readonly></td>
                            <td><input class="form-control" type="text" id="txtTotalCostoProd" name="txtTotalCostoProd"
                                       style="text-align: center;" value="" readonly>
                            </td>
                            <td><input class="form-control" type="text" id="txtUtilidadProd" name="txtUtilidadProd"
                                       style="text-align: center;" value="" readonly></td>
                        </tr>

                        </tbody>
                    </table>
                </div>
            </div>
            <form>
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">MERCADERIA ADQUIRIDA <a href="#modal-add"
                                                                    data-target="#modal-add" data-toggle="modal" class="btn btn-success pull-right" style="margin-top: -8px;"><i class="fa fa-desktop"></i> +</a></h3>

                </div>
                <div class="panel-body">
                    <table style="width: 100%">
                        <thead class="head_costeo">
                        <tr>
                            <th style="text-align: center;" width="450">
                                DETALLE
                            </th>
                            <th style="text-align: center;" width="250">
                                PROVEEDOR
                            </th>
                            <th style="text-align: center;" width="100">
                                N°DOC
                            </th>
                            <th style="text-align: center;">
                                CAN
                            </th>
                            <th style="text-align: center;">
                                C.U $ SIN
                            </th>
                            <th style="text-align: center;">
                                C.U $ IGV
                            </th>
                            <th style="text-align: center;">
                                TOTAL
                            </th>
                            <th style="text-align: center;">
                                C.U S/
                            </th>
                            <th style="text-align: center;">
                                TOTAL
                            </th>
                            <th style="text-align: center;">
                                UTILIDAD
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <input type="hidden" name="cantMerca" value="{{count($mercaderia)}}">
                        @foreach ($mercaderia as $merca)
                            <tr>
                                <td width="300">
                                    <input name="txt_new_product{{ $merca->numPack }}" class="form-control"
                                           type="text" value="{{ $merca->item }}"
                                           size="50">
                                </td>
                                <td>
                                    <select name="txt_proveedor" id="txt_proveedor" class="form-control selectpicker"  data-live-search="true">
                                        @foreach($proveedores as $proveedor)
                                            @if($proveedor->codiProveedor == $merca->codiProveedor)
                                                <option value="{{$proveedor->codiProveedor}}"
                                                        selected>{{$proveedor->nombreProveedor}}</option>
                                            @else
                                                <option value="{{$proveedor->codiProveedor}}">{{$proveedor->nombreProveedor}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </td>
                                <td><input type="text" class="form-control"></td>
                                <td>
                                    <input class="form-control" type="text" id="txt_cantidad{{ $merca->numPack }}"
                                           name="txt_cantidad{{ $merca->numPack }}"
                                           value="{{ $merca->cantidad }}"
                                           size="2" style="text-align: center;">
                                </td>
                                <td>
                                    <input class="form-control" type="text"
                                           id="txt_cus_dolar_sin{{ $merca->numPack }}"
                                           name="txt_cus_dolar_sin{{ $merca->numPack }}"
                                           value="{{ number_format($merca->costoUniDolarSIN, 2, '.', '') }}"
                                           size="10"
                                           style="text-align: center;">
                                </td>
                                <td>
                                    <input class="form-control" type="text" id="txt_cus_dolar{{ $merca->numPack }}"
                                           name="txt_cus_dolar{{ $merca->numPack }}"
                                           value="{{ number_format($merca->costoUniDolar, 2, '.', '') }}" size="10"
                                           style="text-align: center;" readonly>
                                </td>
                                <td>
                                    <input class="form-control mercaTotalDolar" type="text" id="txt_total_dolar{{ $merca->numPack }}"
                                           name="txt_total_dolar{{ $merca->numPack }}"
                                           value="{{ number_format($merca->totalDolar, 2, '.', '') }}" size="10"
                                           style="text-align: center;" readonly>
                                </td>
                                <td>
                                    <input class="form-control mercaCUS" type="text" id="txt_cus_soles{{ $merca->numPack }}"
                                           name="txt_cus_soles{{ $merca->numPack }}"
                                           value="{{ number_format($merca->costoUniSoles, 2, '.', '') }}"
                                           size="10"
                                           style="text-align: center;" readonly>
                                </td>
                                <td>
                                    <input class="form-control mercaTotal" type="text" id="txt_total_soles{{ $merca->numPack }}"
                                           name="txt_total_soles{{ $merca->numPack }}"
                                           value="{{ number_format($merca->totalSoles, 2, '.', '') }}"
                                           size="10"
                                           style="text-align: center;" readonly>
                                </td>
                                <td>
                                    <input class="form-control mercaUti" type="text" id="txt_utilidad"
                                           name="txt_utilidad"
                                           value="{{ number_format($merca->utilidad, 2, '.', '') }}"
                                           size="10"
                                           style="text-align: center;" readonly>
                                </td>
                                <td>&nbsp;</td>
                                <td>

                                    <a id="modal-{{$merca->codiMercaderia}}"
                                       href="#modal-container-{{$merca->codiMercaderia}}" role="button"
                                       class="btn btn-danger btn-xs" data-toggle="modal"><i class="fa fa-close"></i></a>

                                    <div class="modal fade" id="modal-container-{{$merca->codiMercaderia}}"
                                         role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <form>
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="codiMercaderia" id="codiMercaderia"
                                                   value="{{$merca->codiMercaderia}}">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="myModalLabel">
                                                            ELIMINAR COSTEO
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        {{$merca->item}}
                                                    </div>
                                                    <div class="modal-footer">
                                                        <input type="hidden" id="row{{$merca->codiMercaderia}}">
                                                        <button id="{{$merca->codiMercaderia}}"
                                                                type="button"
                                                                class="btn btn-success btnDelCosteo"
                                                                data-dismiss="modal">
                                                            Confirmar
                                                        </button>
                                                        <button type="button"
                                                                class="btn btn-danger"
                                                                data-dismiss="modal">
                                                            Cerrar
                                                        </button>
                                                    </div>
                                                </div>

                                            </div>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        <tr id="addRow">
                            <td colspan="6"></td>
                            <td><input class="form-control" id="txtTotalDolarMerca" type="text"style="text-align: center;" readonly></td>
                            <td><input class="form-control" id="txtTotalCUSMerca" type="text"style="text-align: center;" readonly></td>
                            <td><input class="form-control" id="txtTotalMerca" type="text"style="text-align: center;" readonly></td>
                            <td><input class="form-control" id="txtTotalUtiMerca" type="text"style="text-align: center;" readonly></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">

                </div>
                <div class="col-md-4">
                    <table>
                        <thead>
                            <th class="col-center">BALANCE $</th>
                            <th class="col-center">BALANCE S/</th>
                            <th class="col-center">BALANCE UTILIDAD</th>
                        </thead>
                        <tbody>
                        <form>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="txtCodiCotiFinal" value="{{ $cotizacionFinal->codiCotiFinal }}">
                            <tr>
                                <td><input type="text" class="form-control" id="txtMontoTotalDolar" name="txtMontoTotalDolar" style="text-align: center" value=""></td>
                                <td><input type="text" class="form-control" id="txtMontoTotalSoles" name="txtMontoTotalSoles" style="text-align: center" value=""></td>
                                <td><input type="text" class="form-control" id="txtMontoTotalUti" name="txtMontoTotalUti" style="text-align: center" value=""></td>
                            </tr>
                        </form>
                        </tbody>
                    </table>

                </div>
            </div>
            <br>
                <div class="row">
                    <div class="col-md-8">
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <button type="button" class="btn btn-success pull-right" id="btnGuardarMercaderia"
                                    name="btnGuardarMercaderia" style="width: 45%; margin-left: 2px;">Guardar
                            </button>
                            {{--<button class="btn btn-danger pull-right" id="btnCancelarMercaderia" name="btnCancelarMercaderia" style="width: 45%;">Cancelar</button>--}}
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{--modal agregar nuevo costeo--}}
    <div class="modal fade modal-slide-in-right" aria-hidden="true"
         role="dialog" tabindex="-1" id="modal-add">

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">x</span>
                    </button>
                    <h4 class="modal-title">AGREGAR COSTEO</h4>
                </div>
                <div class="modal-body">
                    <center>¿Agregar otro producto?
                    </center>
                </div>
                <div class="modal-footer">
                    <button type="button"
                            class="btn btn-danger"
                            data-dismiss="modal">
                        Cerrar
                    </button>
                    <button type="button"
                            class="btn btn-success"
                            data-dismiss="modal"
                            id="btn_addCosteo">
                        Confirmar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            calculosProductos();
            calculosMercaderia();
            calculosTotales();
            //crear nuevo costeo
            $('#btn_addCosteo').on('click', function () {
                var content = '';
                datos = {
                    '_token': $('input[name=_token]').val(),
                    txtTotalDolar: $('input[name=txtTotalDolar]').val(),
                    txtCodiCotiFinal: $('input[name=txtCodiCotiFinal]').val(),
                };

                $.ajax({
                    type: 'POST',
                    dataType: 'JSON',
                    url: "{{ URL::to('addItemCosteo') }}",
                    data: datos,
                    success: function (response) {
                        console.log(response);
                        if (response != 0) {
                            content += "<tr>";
                            content += "<td width='300'>";
                            content += "<input name='txt_new_product" + response.numPack + "' class='form-control ' value='" + response.item + "' type='text' value='1' size='50'>";
                            content += "</td>";
                            content += "<td>";
                            content += "<select name='txt_proveedor' id='txt_proveedor' class='form-control selectpicker' data-live-search='true'>";
                            content += "@foreach($proveedores as $proveedor)<option value='{{$proveedor->codiProveedor}}'>{{$proveedor->nombreProveedor}}</option> @endforeach";
                            content += "</select>";
                            content += "</td>";
                            content += "<td><input type='text' class='form-control'></td>";
                            content += "<td><input class='form-control' type='text' id='txt_cantidad1' name='txt_cantidad1' value='" + response.cantidad + "' size='2' style='text-align: center;'>";
                            content += "</td>";
                            content += "<td><input class='form-control' type='text' id='txt_cus_dolar_sin1' name='txt_cus_dolar_sin1' value='" + response.costoUniDolarSIN + "' size='10' style='text-align: center;'>";
                            content += "</td>";
                            content += "<td><input class='form-control' type='text' id='txt_cus_dolar1' name='txt_cus_dolar1' value='" + response.costoUniDolar + "' size='10' style='text-align: center;' readonly>";
                            content += "</td>";
                            content += "<td>";
                            content += "<input class='form-control' type='text' id='txt_total_dolar1' name='txt_total_dolar1' value='" + response.totalDolar + "' size='10' style='text-align: center;' readonly>";
                            content += "</td>";
                            content += "<td>";
                            content += "<input class='form-control' type='text' id='txt_cus_soles1' name='txt_cus_soles1' value='" + response.costoUniSoles + "' size='10' style='text-align: center;' readonly>";
                            content += "</td>";
                            content += "<td>";
                            content += "<input class='form-control' type='text' id='txt_total_soles1' name='txt_total_soles1' value='" + response.totalSoles + "' size='10' style='text-align: center;' readonly>";
                            content += "</td>";
                            content += "<td><input class='form-control' type='text' id='txt_utilidad' name='txt_utilidad' value='" + response.utilidad + "' size='10' style='text-align: center;' readonly>";
                            content += "</td>";
                            content += "<td>&nbsp;</td>";
                            content += "<td>";
                            content += "<a id='modal-"+response.codiMercaderia+"' href='#modal-container-"+response.codiMercaderia+"' role='button' class='btn btn-danger btn-xs' data-toggle='modal'><i class='fa fa-close'></i></a>";
                            content += "<div class='modal fade' id='modal-container-"+response.codiMercaderia+"' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>";
                            content += "<form>";
                            content += "<input type='hidden' name='_token' value='{{ csrf_token() }}'>";
                            content += "<input type='hidden' name='codiMercaderia' id='codiMercaderia'";
                            content += "value='"+response.codiMercaderia+"'>";
                            content += "<div class='modal-dialog' role='document'>";
                            content += "<div class='modal-content'>";
                            content += "<div class='modal-header'>";
                            content += "<h5 class='modal-title' id='myModalLabel'>ELIMINAR COSTEO</h5>";
                            content += "<button type='button' class='close' data-dismiss='modal'>";
                            content += "<span aria-hidden='true'>×</span>";
                            content += "</button>";
                            content += "</div>";
                            content += "<div class='modal-body'>";
                            content += ""+response.item+"";
                            content += "</div>";
                            content += "<div class='modal-footer'>";
                            content += "<input type='hidden' id='row"+response.codiMercaderia+"'>";
                            content += "<button id='"+response.codiMercaderia+"' type='button' class='btn btn-success btnDelCosteo' data-dismiss='modal'>Confirmar </button>";
                            content += "<button type='button' class='btn btn-danger' data-dismiss='modal'>Cerrar</button>";
                            content += "</div>";
                            content += "</div>";

                            content += "</div>";
                            content += "</form>";
                            content += "</div>";
                            content += "</td>";

                            content += "</tr>";

                            $('#addRow').before(content);

                            $('.selectpicker').selectpicker('refresh');
                        } else {
                            console.log("error en la petición http");
                        }
                    },
                    error: function (error) {
                        console.log(error.message)
                    }
                });
            });

            $('#btnGuardarMercaderia').click(function(){
                datos = {
                    '_token': $('input[name=_token]').val(),
                    cantMerca : $('input[name=cantMerca]').val()
                };

                $.ajax({
                    type: 'POST',
                    dataType: 'JSON',
                    url: "{{ URL::to('saveMercaderia') }}",
                    data: datos,
                    success: function (response) {
                        console.log(response);
                    },
                    error: function (error) {
                        console.log(error.message)
                    }
                });
            });
        });

        $(document).on('click', '.btnDelCosteo', function(){
            var id = $(this).attr('id');
            datos = {
                '_token': $('input[name=_token]').val(),
                codiMercaderia: id
            };

            $.ajax({
                type: 'POST',
                dataType: 'JSON',
                url: "{{ URL::to('delItemCosteo') }}",
                data: datos,
                success: function (response) {
                    console.log(response);
                    $('#row'+id).closest('tr').remove();
                    calculosMercaderia();
                    calculosTotales();
                },
                error: function (error) {
                    console.log(error.message)
                }
            });
        });

//        $(document).on('click', '.btnDelCosteo', function (event) {
//            event.preventDefault();
////            $(this).closest('tr').remove();
//            $(this).closest('tr').css("background-color", "yellow");
//        });

        function calculosProductos(){
            var sumCU = 0.0;
            var sumCUS = 0.0;
            var sumCosto = 0.0;
            var sumUti = 0.0;

            $('.totalCU').each(function(){
                var monto = parseFloat($(this).val());
                sumCU += monto;
            });
            $('#txtTotalDolarSIN').val(parseFloat(sumCU).toFixed(2));


            $('.totalCUS').each(function(){
                var montoCUS = parseFloat($(this).val());
                sumCUS += montoCUS;
            });
            $('#txtCUSProd').val(parseFloat(sumCUS).toFixed(2));

            $('.totalProd').each(function(){
                var montoProd = parseFloat($(this).val());
                sumCosto += montoProd;
            });
            $('#txtTotalCostoProd').val(parseFloat(sumCosto).toFixed(2));

            $('.totalUtiProd').each(function(){
                var montoUti = parseFloat($(this).val());
                sumUti += montoUti;
            });
            $('#txtUtilidadProd').val(parseFloat(sumUti).toFixed(2));
        }

        function calculosMercaderia(){
            var sumCUM = 0.0;
            var sumCUSM = 0.0;
            var sumCostoM = 0.0;
            var sumUtiM = 0.0;

            $('.mercaTotalDolar').each(function(){
                var montoMerca = parseFloat($(this).val());
                sumCUM += montoMerca;
            });
            $('#txtTotalDolarMerca').val(parseFloat(sumCUM).toFixed(2));


            $('.mercaCUS').each(function(){
                var montoMercaCUS = parseFloat($(this).val());
                sumCUSM += montoMercaCUS;
            });
            $('#txtTotalCUSMerca').val(parseFloat(sumCUSM).toFixed(2));

            $('.mercaTotal').each(function(){
                var montoMercaProd = parseFloat($(this).val());
                sumCostoM += montoMercaProd;
            });
            $('#txtTotalMerca').val(parseFloat(sumCostoM).toFixed(2));

            $('.mercaUti').each(function(){
                var montoMercaUti = parseFloat($(this).val());
                sumUtiM += montoMercaUti;
            });
            $('#txtTotalUtiMerca').val(parseFloat(sumUtiM).toFixed(2));

        }

        function calculosTotales(){

            var totalDolarProductos = parseFloat($('#txtTotalDolarSIN').val());
            var totalDolarMerca = parseFloat($('#txtTotalDolarMerca').val());

            var txtTotalCostoProd = parseFloat($('#txtTotalCostoProd').val());
            var txtTotalMerca = parseFloat($('#txtTotalMerca').val());

            var txtUtilidadProd = parseFloat($('#txtUtilidadProd').val());
            var txtTotalUtiMerca = parseFloat($('#txtTotalUtiMerca').val());

            $('#txtMontoTotalDolar').val((totalDolarProductos-totalDolarMerca).toFixed(2));
            $('#txtMontoTotalSoles').val((txtTotalCostoProd-txtTotalMerca).toFixed(2));
            $('#txtMontoTotalUti').val((txtUtilidadProd-txtTotalUtiMerca).toFixed(2));
        }
    </script>
@endsection