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
                    <a href="{{ url('cotizacionFinal') }}">Cierres</a>
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
                <b style="color:#9f191f; font-size: 22px;">{{ $cotizacion->numCoti }}</b>
                {{--->{{$cotizacionFinal->codiCotiFinal}}--}}
                <p>Fecha: {{ Carbon\Carbon::parse($cotizacion->fechaCoti)->format('d-m-Y') }}</p>
            </h3>

            <hr>
            <div class="panel panel-danger">
                <div class="panel-heading">
                    <h3 class="panel-title">COTIZACION</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-striped table-bordered table-condensed table-hover">
                        <thead class="head_costeo">
                        <tr>
                            <th style="text-align: center;" width="450">
                                DETALLE
                            </th>
                            <th style="text-align: center;">
                                CAN
                            </th>
                            <th style="text-align: center;">
                                P.U.S/
                            </th>
                            <th style="text-align: center;">
                                P.T.S/
                            </th>
                            <th style="text-align: center;">
                                UTIL
                            </th>
                            <th style="text-align: center;">
                                MARGEN
                            </th>
                            <th style="text-align: center;">
                                C.U.$
                            </th>
                            <th style="text-align: center;">
                                C.T.$
                            </th>
                            <th style="text-align: center;">
                                C.U. S/
                            </th>
                            <th style="text-align: center;">
                                C.T. S/
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
                                    <input class="form-control" type="text" id="txt_cantidad{{ $producto->numPack }}"
                                           name="txt_cantidad{{ $producto->numPack }}"
                                           value="{{ $producto->cantiCoti }}"
                                           size="10" style="text-align: center;" readonly>
                                </td>
                                <td>
                                    <input class="form-control" type="text" id="txt_pu_soles"
                                           name="txt_pu_soles"
                                           value="{{ $producto->precioUniSoles }}"
                                           size="10" style="text-align: center;" readonly>
                                    {{--<input type="text" class="form-control" readonly value="{{$producto->nombreProveedor}}">--}}
                                </td>

                                <td>
                                    <input class="form-control" type="text" id="txt_pt"
                                           name="txt_pt"
                                           value="{{ $producto->precioTotal }}"
                                           size="10" style="text-align: center;" readonly>
                                    {{--<input type="text" class="form-control" readonly value="{{$producto->nombreProveedor}}">--}}
                                </td>
                                <td>
                                    <input class="form-control totalUtiProd" type="text" id="txtUtiCoti{{ $producto->numPack }}"
                                           name="txtUtiCoti{{ $producto->numPack }}"
                                           value="{{ number_format($producto->utiCoti, 2, '.', '') }}"
                                           size="10"
                                           style="text-align: center;" readonly>
                                </td>
                                <td>
                                    <input class="form-control totalUtiProd" type="text" id="txtMargenVenta"
                                           name="txtMargenVenta"
                                           value="{{ number_format($producto->margenVentaCoti, 2, '.', '') }}"
                                           size="10"
                                           style="text-align: center;" readonly>
                                </td>

                                <td>
                                    <input class="form-control" type="text" id="txt_cus_dolar{{ $producto->numPack }}"
                                           name="txt_cus_dolar{{ $producto->numPack }}"
                                           value="{{ number_format($producto->costoUniIgv, 2, '.', '') }}"
                                           size="10"
                                           style="text-align: center;" readonly>
                                </td>
                                <td>
                                    <input class="form-control totalCU" type="text" id="txt_total_dolar{{ $producto->numPack }}"
                                           name="txt_total_dolar{{ $producto->numPack }}"
                                           value="{{ number_format($producto->costoTotalIgv, 2, '.', '') }}"
                                           size="10"
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

                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="6"></td>
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

            <div class="panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title">FACTURACION</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-striped table-bordered table-condensed table-hover">
                        <thead class="head_costeo">
                        <tr>
                            <th style="text-align: center;">
                                COD. INT
                            </th>
                            <th style="text-align: center;">
                                CANT
                            </th>
                            <th style="text-align: center;">
                                DESCRIPCION
                            </th>
                            <th style="text-align: center;">
                                P.U.S/
                            </th>
                            <th style="text-align: center;">
                                DCTOS
                            </th>
                            <th style="text-align: center;">
                                V. TOTAL
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(isset($pFacturados))
                            @foreach ($pFacturados as $pFacturado)
                                <tr>
                                    <td>
                                        <input type="text" name="txtCodInternoFact{{ $pFacturado->numPack }}"
                                               id="txtCodInternoFact{{ $pFacturado->numPack }}" class="form-control" readonly
                                               size="10"
                                               value="{{$pFacturado->codInterno}}">
                                    </td>
                                    <td>
                                        <input class="form-control" type="text" id="txt_cantidad{{ $pFacturado->numPack }}"
                                               name="txt_cantidad{{ $pFacturado->numPack }}"
                                               value="{{ $pFacturado->cantidad }}"
                                               size="10" style="text-align: center;" readonly>
                                    </td>
                                    <td>
                                        <input name="txt_new_product{{ $pFacturado->numPack }}" class="form-control"
                                               type="text" value="{{ $pFacturado->item }}"
                                               size="70" readonly>
                                    </td>

                                    <td>
                                        <input class="form-control" type="text"
                                               id="txt_pu{{ $pFacturado->numPack }}"
                                               name="txt_pu{{ $pFacturado->numPack }}"
                                               value="{{ number_format($pFacturado->precioU, 2, '.', '') }}"
                                               size="5"
                                               style="text-align: center;" readonly>
                                    </td>
                                    <td>
                                        <input class="form-control" type="text" id="txt_dctos{{ $pFacturado->numPack }}"
                                               name="txt_dctos{{ $pFacturado->numPack }}"
                                               value="{{ number_format($pFacturado->dctos, 2, '.', '') }}" size="5"
                                               style="text-align: center;" readonly>
                                    </td>
                                    <td>
                                        <input class="form-control totalCU" type="text" id="txt_pt{{ $pFacturado->numPack }}"
                                               name="txt_pt{{ $pFacturado->numPack }}"
                                               value="{{ number_format($pFacturado->precioT, 2, '.', '') }}" size="5"
                                               style="text-align: center;" readonly>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        <tr>
                            <td colspan="3"></td>
                            {{--<td><input class="form-control" type="text" id="txtTotalDolarSIN" name="txtTotalDolarSIN"--}}
                                       {{--style="text-align: center;" value="" readonly></td>--}}
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

            <form action="{{ URL::to('saveMercaderia') }}" method="POST">
                <input type="hidden" name="codiCotiFinal" id="codiCotiFinal" value="{{ $cotizacionFinal->codiCotiFinal }}">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">COMPRAS <a href="#modal-add"
                                                                    data-target="#modal-add" data-toggle="modal" class="btn btn-success pull-right" style="margin-top: -8px;"><i class="fa fa-desktop"></i> +</a></h3>

                </div>
                <div class="panel-body">
                    <table style="width: 100%">
                        <thead class="head_costeo">
                        <tr>
                            <th>
                                COD. INT
                            </th>
                            <th style="text-align: center;" width="450">
                                DETALLE
                            </th>
                            <th style="text-align: center;" width="250">
                                PROVEEDOR
                            </th>
                            <th style="text-align: center;" width="100">
                                FAC.
                            </th>
                            <th style="text-align: center;">
                                CANT
                            </th>
                            <th style="text-align: center;">
                                C.U. $
                            </th>
                            <th style="text-align: center;">
                                C.T. $
                            </th>
                            <th style="text-align: center;">
                                C.U. S/
                            </th>
                            <th style="text-align: center;">
                                C.T. S/
                            </th>
                            <th style="text-align: center;">
                                UTILIDAD
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(isset($pFacturados))
                            <input type="hidden" name="cantMerca" id="cantMerca" value="{{count($pFacturados)}}">
                            @foreach ($pFacturados as $pFacturado)
                                <tr>
                                    <td>
                                        {{--cod int--}}
                                        <input type="text" name="txtCodInt{{ $pFacturado->numPack }}"
                                               id="txtCodInt{{ $pFacturado->numPack }}" class="form-control"
                                               value="{{  $pFacturado->codInterno }}">
                                    </td>
                                    <td width="300">
                                        {{--item--}}
                                        <input name="txt_new_merca{{ $pFacturado->numPack }}"
                                               class="form-control txt_new_merca"
                                               id="txt_new_merca"
                                               type="text"
                                               value="{{ $pFacturado->item }}"
                                               size="50">
                                    </td>
                                    <td>
                                        {{--proveedor--}}
                                        <select name="txt_prov_merca{{ $pFacturado->numPack }}" id="txt_prov_merca{{ $pFacturado->numPack }}" class="form-control selectpicker"  data-live-search="true">
                                            @foreach($proveedores as $proveedor)
                                                @if($proveedor->codiProveedor == $pFacturado->codiProveedor)
                                                    <option value="{{$proveedor->codiProveedor}}"
                                                            selected>{{$proveedor->nombreProveedor}}</option>
                                                @else
                                                    <option value="{{$proveedor->codiProveedor}}">{{$proveedor->nombreProveedor}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        {{--factura--}}
                                        <input type="text" name="txt_num_doc{{ $pFacturado->numPack }}"
                                               id="txt_num_doc{{ $pFacturado->numPack }}" class="form-control"
                                               value="">
                                    </td>
                                    <td>
                                        {{--cantidad--}}
                                        <input class="form-control class_merca" type="text" id="txt_canti_merca{{ $pFacturado->numPack }}"
                                               name="txt_canti_merca{{ $pFacturado->numPack }}"
                                               value="{{ $pFacturado->cantidad }}"
                                               size="2" style="text-align: center;">
                                    </td>
                                    <td>
                                        {{--cu$--}}
                                        <input class="form-control" type="text" id="txt_cus_merca{{ $pFacturado->numPack }}"
                                               name="txt_cus_merca{{ $pFacturado->numPack }}"
                                               value="0" size="10"
                                               style="text-align: center;">
                                    </td>
                                    <td>
                                        {{--ct$--}}
                                        <input class="form-control mercaTotalDolar" type="text" id="txt_totald_merca{{ $pFacturado->numPack }}"
                                               name="txt_totald_merca{{ $pFacturado->numPack }}"
                                               value="0" size="10"
                                               style="text-align: center;" readonly>
                                    </td>
                                    <td>
                                        {{--cus/--}}
                                        <input class="form-control mercaCUS" type="text" id="txt_cussol_merca{{ $pFacturado->numPack }}"
                                               name="txt_cussol_merca{{ $pFacturado->numPack }}"
                                               value="0"
                                               size="10"
                                               style="text-align: center;">
                                    </td>
                                    <td>
                                        {{--cts/--}}
                                        <input class="form-control mercaTotal" type="text" id="txt_totSoles_merca{{ $pFacturado->numPack }}"
                                               name="txt_totSoles_merca{{ $pFacturado->numPack }}"
                                               value="0"
                                               size="10"
                                               style="text-align: center;" readonly>
                                    </td>
                                    <td>
                                        {{--utilidad--}}
                                        <input class="form-control mercaUti" type="text" id="txt_utilidad_merca{{ $pFacturado->numPack }}"
                                               name="txt_utilidad_merca{{ $pFacturado->numPack }}"
                                               value="0"
                                               size="10"
                                               style="text-align: center;" readonly>
                                    </td>
                                    <td>
                                        {{--margen--}}
                                        <input class="form-control mercaUti" type="text" id="txt_margen_merca{{ $pFacturado->numPack }}"
                                               name="txt_margen_merca{{ $pFacturado->numPack }}"
                                               value="0"
                                               size="10"
                                               style="text-align: center;" readonly>
                                    </td>
                                    <td>&nbsp;</td>
                                    <td>

                                        {{--<a id="modal-{{$pFacturado->codiMercaderia}}"--}}
                                        {{--href="#modal-container-{{$pFacturado->codiMercaderia}}" role="button"--}}
                                        {{--class="btn btn-danger btn-xs" data-toggle="modal"><i class="fa fa-close"></i></a>--}}

                                        {{--<div class="modal fade" id="modal-container-{{$pFacturado->codiMercaderia}}"--}}
                                        {{--role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">--}}
                                        {{--<form>--}}
                                        {{--<input type="hidden" name="_token" value="{{ csrf_token() }}">--}}
                                        {{--<input type="hidden" name="codiMercaderia" id="codiMercaderia"--}}
                                        {{--value="{{$pFacturado->codiMercaderia}}">--}}
                                        {{--<div class="modal-dialog" role="document">--}}
                                        {{--<div class="modal-content">--}}
                                        {{--<div class="modal-header">--}}
                                        {{--<h5 class="modal-title" id="myModalLabel">--}}
                                        {{--ELIMINAR COSTEO--}}
                                        {{--</h5>--}}
                                        {{--<button type="button" class="close" data-dismiss="modal">--}}
                                        {{--<span aria-hidden="true">×</span>--}}
                                        {{--</button>--}}
                                        {{--</div>--}}
                                        {{--<div class="modal-body">--}}
                                        {{--{{$pFacturado->item}}--}}
                                        {{--</div>--}}
                                        {{--<div class="modal-footer">--}}
                                        {{--<input type="hidden" id="row{{$pFacturado->codiMercaderia}}">--}}
                                        {{--<button id="{{$pFacturado->codiMercaderia}}"--}}
                                        {{--type="button"--}}
                                        {{--class="btn btn-success btnDelCosteo"--}}
                                        {{--data-dismiss="modal">--}}
                                        {{--Confirmar--}}
                                        {{--</button>--}}
                                        {{--<button type="button"--}}
                                        {{--class="btn btn-danger"--}}
                                        {{--data-dismiss="modal">--}}
                                        {{--Cerrar--}}
                                        {{--</button>--}}
                                        {{--</div>--}}
                                        {{--</div>--}}

                                        {{--</div>--}}
                                        {{--</form>--}}
                                        {{--</div>--}}
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        <tr id="addRow">
                            <td colspan="5"></td>
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
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="txtCodiCotiFinal" value="{{ $cotizacionFinal->codiCotiFinal }}">
                        <tr>
                            <td><input type="text" class="form-control" id="txtMontoTotalDolar"
                                       name="txtMontoTotalDolar" style="text-align: center" value=""></td>
                            <td><input type="text" class="form-control" id="txtMontoTotalSoles"
                                       name="txtMontoTotalSoles" style="text-align: center" value=""></td>
                            <td><input type="text" class="form-control" id="txtMontoTotalUti" name="txtMontoTotalUti"
                                       style="text-align: center" value=""></td>
                        </tr>
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
                            <button type="submit" class="btn btn-success pull-right" id="btnGuardarMercaderia"
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
                            content += "<input name='txt_new_merca" + response.numPack + "' class='form-control' value='" + response.item + "' type='text' value='1' size='50'>";
                            content += "</td>";
                            content += "<td>";
                            content += "<select name='txt_prov_merca" + response.numPack + "' id='txt_prov_merca' class='form-control selectpicker' data-live-search='true'>";
                            content += "@foreach($proveedores as $proveedor)<option value='{{$proveedor->codiProveedor}}'>{{$proveedor->nombreProveedor}}</option> @endforeach";
                            content += "</select>";
                            content += "</td>";
                            content += "<td><input type='text' name='txt_num_doc" + response.numPack + "' id='txt_num_doc" + response.numPack + "' class='form-control class_merca' value=''></td>";
                            content += "<td><input class='form-control class_merca' type='text' id='txt_canti_merca" + response.numPack + "' name='txt_canti_merca" + response.numPack + "' value='" + response.cantidad + "' size='2' style='text-align: center;'>";
                            content += "</td>";
                            content += "<td><input class='form-control class_merca' type='text' id='txt_cusd_sin_merca" + response.numPack + "' name='txt_cusd_sin_merca" + response.numPack + "' value='" + response.costoUniDolarSIN + "' size='10' style='text-align: center;'>";
                            content += "</td>";
                            content += "<td><input class='form-control' type='text' id='txt_cus_merca' name='txt_cus_merca" + response.numPack + "' value='" + response.costoUniDolar + "' size='10' style='text-align: center;' readonly>";
                            content += "</td>";
                            content += "<td>";
                            content += "<input class='form-control' type='text' id='txt_totald_merca' name='txt_totald_merca" + response.numPack + "' value='" + response.totalDolar + "' size='10' style='text-align: center;' readonly>";
                            content += "</td>";
                            content += "<td>";
                            content += "<input class='form-control' type='text' id='txt_cussol_merca' name='txt_cussol_merca" + response.numPack + "' value='" + response.costoUniSoles + "' size='10' style='text-align: center;' readonly>";
                            content += "</td>";
                            content += "<td>";
                            content += "<input class='form-control' type='text' id='txt_totSoles_merca' name='txt_totSoles_merca" + response.numPack + "' value='" + response.totalSoles + "' size='10' style='text-align: center;' readonly>";
                            content += "</td>";
                            content += "<td><input class='form-control' type='text' id='txt_utilidad_merca' name='txt_utilidad_merca' value='" + response.utilidad + "' size='10' style='text-align: center;' readonly>";
                            content += "</td>";
                            content += "<td>&nbsp;</td>";
                            content += "<td>";
                            content += "<a id='modal-" + response.codiMercaderia + "' href='#modal-container-" + response.codiMercaderia + "' role='button' class='btn btn-danger btn-xs' data-toggle='modal'><i class='fa fa-close'></i></a>";
                            content += "<div class='modal fade' id='modal-container-" + response.codiMercaderia + "' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>";
                            content += "<form>";
                            content += "<input type='hidden' name='_token' value='{{ csrf_token() }}'>";
                            content += "<input type='hidden' name='codiMercaderia' id='codiMercaderia'";
                            content += "value='" + response.codiMercaderia + "'>";
                            content += "<div class='modal-dialog' role='document'>";
                            content += "<div class='modal-content'>";
                            content += "<div class='modal-header'>";
                            content += "<h5 class='modal-title' id='myModalLabel'>ELIMINAR COSTEO</h5>";
                            content += "<button type='button' class='close' data-dismiss='modal'>";
                            content += "<span aria-hidden='true'>×</span>";
                            content += "</button>";
                            content += "</div>";
                            content += "<div class='modal-body'>";
                            content += "" + response.item + "";
                            content += "</div>";
                            content += "<div class='modal-footer'>";
                            content += "<input type='hidden' id='row" + response.codiMercaderia + "'>";
                            content += "<button id='" + response.codiMercaderia + "' type='button' class='btn btn-success btnDelCosteo' data-dismiss='modal'>Confirmar </button>";
                            content += "<button type='button' class='btn btn-danger' data-dismiss='modal'>Cerrar</button>";
                            content += "</div>";
                            content += "</div>";

                            content += "</div>";
                            content += "</form>";
                            content += "</div>";
                            content += "</td>";

                            content += "</tr>";

                            $('#addRow').before(content);
                            $('#cantMerca').val(response.numPack);
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

            $('.class_merca').keyup(function () {
                var cc = parseInt($("#cantMerca").val());
                var dolar = parseFloat($('#txt_dolar').val());
                var igv = parseFloat($('#txt_igv').val());
                for (var i = 1; i <= cc; i++) {
                    if ($(this).attr('name') === 'txt_canti_merca' + i || $(this).attr('name') === 'txt_cusd_sin_merca' + i) {
                        //selectores para setear datos
                        var txt_canti_merca = "#txt_canti_merca" + i;
                        var txt_cusd_sin_merca = "#txt_cusd_sin_merca" + i;
                        //selectores para mostrar datos
                        var txt_cus_merca = "#txt_cus_merca" + i;
                        var txt_totald_merca = "#txt_totald_merca" + i;
                        var txt_cussol_merca = "#txt_cussol_merca" + i;
                        var txt_totSoles_merca = "#txt_totSoles_merca" + i;
                        var txt_utilidad_merca = "#txt_utilidad_merca" + i;

                        //variables
                        var cantidad = parseFloat($(txt_canti_merca).val());
                        var costo_dolares = parseFloat($(txt_cusd_sin_merca).val());

//                    var cus_merca = parseFloat($(txt_cus_merca).val());
//                    var totald_merca = parseFloat($(txt_totald_merca).val());
//                    var cussol_merca = parseFloat($(txt_cussol_merca).val());
//                    var totSoles_merca = parseFloat($(txt_totSoles_merca).val());
//                    var utilidad_merca = parseFloat($(txt_utilidad_merca).val());

                        var cu_dol_igv = (costo_dolares + (costo_dolares * igv)).toFixed(2);
                        var total_dol_igv = (cantidad * cu_dol_igv).toFixed(2);
                        var cus = (cu_dol_igv * dolar).toFixed(2);
                        var total_cus = (cus * cantidad).toFixed(2);
                        var utilidad = (cus * cantidad).toFixed(2);

                        $(txt_cus_merca).val(cu_dol_igv);
                        $(txt_totald_merca).val(total_dol_igv);
                        $(txt_cussol_merca).val(cus);
                        $(txt_totSoles_merca).val(total_cus);

                        calculosMercaderia();
                        calculosTotales();
                    }
                }
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