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
                                        <input name="txt_new_product{{ $producto->numPack }}" class="form-control txt_new_product"
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
                                <td> {{--PUS--}}
                                    <input class="form-control txtCotPUS" type="text" id="txtCotPUS"
                                           name="txtCotPUS"
                                           value="{{ number_format($producto->precioUniSoles, 2, '.', '') }}"
                                           size="10" style="text-align: center;" readonly>
                                    {{--<input type="text" class="form-control" readonly value="{{$producto->nombreProveedor}}">--}}
                                </td>

                                <td> {{-- P.T.S/ --}}
                                    <input class="form-control txtCotPTS" type="text" id="txtCotPTS"
                                           name="txtCotPTS"
                                           value="{{ number_format($producto->precioTotal, 2, '.', '') }}"
                                           size="10" style="text-align: center;" readonly>
                                    {{--<input type="text" class="form-control" readonly value="{{$producto->nombreProveedor}}">--}}
                                </td>
                                <td> {{-- UTIL  --}}
                                    <input class="form-control txtCotUTIL" type="text" id="txtCotUTIL"
                                           name="txtCotUTIL"
                                           value="{{ number_format($producto->utiCoti, 2, '.', '') }}"
                                           size="10"
                                           style="text-align: center;" readonly>
                                </td>
                                <td>
                                    <input class="form-control txtCotMARGEN" type="text" id="txtCotMARGEN"
                                           name="txtCotMARGEN"
                                           value="{{ number_format($producto->margenVentaCoti, 2, '.', '') }}"
                                           size="10"
                                           style="text-align: center;" readonly>
                                </td>

                                <td>
                                    <input class="form-control txtCotCUD" type="text" id="txtCotCUD"
                                           name="txtCotCUD"
                                           value="{{ number_format($producto->costoUniIgv, 2, '.', '') }}"
                                           size="10"
                                           style="text-align: center;" readonly>
                                </td>
                                <td>
                                    <input class="form-control totalCU txtCotCTD" type="text" id="txtCotCTD"
                                           name="txtCotCTD"
                                           value="{{ number_format($producto->costoTotalIgv, 2, '.', '') }}"
                                           size="10"
                                           style="text-align: center;" readonly>
                                </td>
                                <td>
                                    <input class="form-control txtCotCUS" type="text" id="txtCotCUS"
                                           name="txtCotCUS"
                                           value="{{ number_format($producto->costoUniSolesIgv, 2, '.', '') }}"
                                           size="10"
                                           style="text-align: center;" readonly>
                                </td>
                                <td>
                                    <input class="form-control txtCotCTS" type="text" id="txtCotCTS"
                                           name="txtCotCTS"
                                           value="{{ number_format($producto->costoTotalSolesIgv, 2, '.', '') }}"
                                           size="10"
                                           style="text-align: center;" readonly>
                                </td>

                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="2"></td>
                            <td><input class="form-control" type="text" id="txtCotTotalPUS" name="txtCotTotalPUS"
                                       style="text-align: center;" value="" readonly></td>
                            <td><input class="form-control" type="text" id="txtCotTotalPTS" name="txtCotTotalPTS"
                                       style="text-align: center;" value="" readonly></td>
                            <td><input class="form-control" type="text" id="txtCotTotalUTIL" name="txtCotTotalUTIL"
                                       style="text-align: center;" value="" readonly></td>
                            <td><input class="form-control" type="text" id="txtCotTotalMARGEN" name="txtCotTotalMARGEN"
                                       style="text-align: center;" value="" readonly></td>
                            <td><input class="form-control" type="text" id="txtCotTotalCUD" name="txtCotTotalCUD"
                                       style="text-align: center;" value="" readonly></td>
                            <td><input class="form-control" type="text" id="txtCotTotalCTD" name="txtCotTotalCTD"
                                       style="text-align: center;" value="" readonly></td>
                            <td><input class="form-control" type="text" id="txtCotTotalCUS" name="txtCotTotalCUS"
                                       style="text-align: center;" value="" readonly>
                            </td>
                            <td><input class="form-control" type="text" id="txtCotTotalCTS" name="txtCotTotalCTS"
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
                                        <input type="text" name="txtCodInternoFact"
                                               id="txtCodInternoFact"
                                               class="form-control"
                                               size="10"
                                               value="{{$pFacturado->codInterno}}" readonly>
                                    </td>
                                    <td>
                                        <input class="form-control" type="text" id="txt_cantidad"
                                               name="txt_cantidad"
                                               value="{{ $pFacturado->cantidad }}"
                                               size="10" style="text-align: center;" readonly>
                                    </td>
                                    <td>
                                        <input name="txt_new_product"
                                               class="form-control"
                                               type="text" value="{{ $pFacturado->item }}"
                                               size="70" readonly>
                                    </td>

                                    <td>
                                        <input class="form-control txtFacPUS" type="text"
                                               id="txtFacPUS"
                                               name="txtFacPUS"
                                               value="{{ number_format($pFacturado->precioU, 2, '.', '') }}"
                                               size="5"
                                               style="text-align: center;" readonly>
                                    </td>
                                    <td>
                                        <input class="form-control txtFacDCTOS" type="text"
                                               id="txtFacDCTOS"
                                               name="txtFacDCTOS"
                                               value="{{ number_format($pFacturado->dctos, 2, '.', '') }}" size="5"
                                               style="text-align: center;" readonly>
                                    </td>
                                    <td>
                                        <input class="form-control txtFacTOTAL" type="text"
                                               id="txtFacTOTAL{{ $pFacturado->numPack }}"
                                               name="txtFacTOTAL{{ $pFacturado->numPack }}"
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
                            <td><input class="form-control" type="text" id="txtFacTotalPUS" name="txtFacTotalPUS"
                                       style="text-align: center;" value="" readonly></td>
                            <td><input class="form-control" type="text" id="txtFacTotalDCTOS" name="txtFacTotalDCTOS"
                                       style="text-align: center;" value="" readonly>
                            </td>
                            <td><input class="form-control" type="text" id="txtFacTotalTOTAL" name="txtFacTotalTOTAL"
                                       style="text-align: center;" value="" readonly></td>
                        </tr>

                        </tbody>
                    </table>
                </div>
            </div>

            <form action="{{ URL::to('saveMercaderia') }}" method="POST">
                <input type="text" name="codiCotiFinal" id="codiCotiFinal" value="{{ $cotizacionFinal->codiCotiFinal }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">COMPRAS</h3>
                    {{--<a href="#modal-add"--}}
                    {{--data-target="#modal-add" data-toggle="modal" class="btn btn-success pull-right" style="margin-top: -8px;"><i class="fa fa-desktop"></i> +</a>--}}

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
                            <th style="text-align: center;">
                                MARGEN
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($mercaderia) > 0)
                            <input type="text" name="cantMerca" id="cantMerca" value="{{count($mercaderia)}}">
                            @foreach ($mercaderia as $merca)
                                <input type="text" name="updateMerca" value="1">
                                <input type="text" name="txtCodiMercaderia{{ $merca->numPack }}" value="{{ $merca->codiMercaderia }}">
                                <tr>
                                    <td>
                                        {{--cod int--}}
                                        <input type="text" name="txtCodInt{{ $merca->numPack }}"
                                               id="txtCodInt{{ $merca->numPack }}"
                                               class="form-control"
                                               value="{{  $merca->codInterno }}">
                                    </td>
                                    <td width="300">
                                        {{--item--}}
                                        <input name="txt_new_merca{{ $merca->numPack }}"
                                               class="form-control txt_new_merca"
                                               id="txt_new_merca"
                                               type="text"
                                               value="{{ $merca->item }}"
                                               size="50">
                                    </td>
                                    <td>
                                        {{--proveedor--}}
                                        <select name="txt_prov_merca{{ $merca->numPack }}" id="txt_prov_merca{{ $merca->numPack }}" class="form-control selectpicker"  data-live-search="true">
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
                                    <td>
                                        {{--factura--}}
                                        <input type="text" name="txt_num_doc{{ $merca->numPack }}"
                                               id="txt_num_doc{{ $merca->numPack }}" class="form-control"
                                               value="{{ $merca->numDocumento }}">
                                    </td>
                                    <td>
                                        {{--cantidad--}}
                                        <input class="form-control class_merca" type="text"
                                               id="txt_canti_merca{{ $merca->numPack }}"
                                               name="txt_canti_merca{{ $merca->numPack }}"
                                               value="{{ $merca->cantidad }}"
                                               size="2" style="text-align: center;">
                                    </td>
                                    <td>
                                        {{--cu$--}}
                                        <input class="form-control txtComCUD class_merca" type="text"
                                               id="txtComCUD{{ $merca->numPack }}"
                                               name="txtComCUD{{ $merca->numPack }}"
                                               value="{{ $merca->costoUniDolarSIN }}" size="10"
                                               style="text-align: center;">
                                    </td>
                                    <td>
                                        {{--ct$--}}
                                        <input class="form-control txtComCTD class_merca" type="text"
                                               id="txtComCTD{{ $pFacturado->numPack }}"
                                               name="txtComCTD{{ $pFacturado->numPack }}"
                                               value="{{ $merca->totalDolar }}" size="10"
                                               style="text-align: center;" readonly>
                                    </td>
                                    <td>
                                        {{--cus/--}}
                                        <input class="form-control txtComCUS class_merca" type="text"
                                               id="txtComCUS{{ $merca->numPack }}"
                                               name="txtComCUS{{ $merca->numPack }}"
                                               value="{{ $merca->costoUniSoles }}"
                                               size="10"
                                               style="text-align: center;">
                                    </td>
                                    <td>
                                        {{--cts/--}}
                                        <input class="form-control txtComCTS class_merca" type="text"
                                               id="txtComCTS{{ $merca->numPack }}"
                                               name="txtComCTS{{ $merca->numPack }}"
                                               value="{{ $merca->totalSoles }}"
                                               size="10"
                                               style="text-align: center;" readonly>
                                    </td>
                                    <td>
                                        {{--utilidad--}}
                                        <input class="form-control txtComUtilidad class_merca" type="text"
                                               id="txtComUtilidad{{ $merca->numPack }}"
                                               name="txtComUtilidad{{ $merca->numPack }}"
                                               value="{{ $merca->utilidad }}"
                                               size="10"
                                               style="text-align: center;" readonly>
                                    </td>
                                    <td>
                                        {{--margen--}}
                                        <input class="form-control txtComMargen class_merca" type="text"
                                               id="txtComMargen{{ $merca->numPack }}"
                                               name="txtComMargen{{ $merca->numPack }}"
                                               value="{{ $merca->margen }}"
                                               size="10"
                                               style="text-align: center;" readonly>
                                    </td>
                                </tr>
                            @endforeach
                            {{--<p>Mostrar mercaderia registrada</p>--}}
                        @else
                            <input type="hidden" name="cantMerca" id="cantMerca" value="{{count($pFacturados)}}">
                            @foreach ($pFacturados as $pFacturado)
                                <tr>
                                    <td>
                                        {{--cod int--}}
                                        <input type="text" name="txtCodInt{{ $pFacturado->numPack }}"
                                               id="txtCodInt{{ $pFacturado->numPack }}"
                                               class="form-control"
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
                                        <input class="form-control class_merca" type="text"
                                               id="txt_canti_merca{{ $pFacturado->numPack }}"
                                               name="txt_canti_merca{{ $pFacturado->numPack }}"
                                               value="{{ $pFacturado->cantidad }}"
                                               size="2" style="text-align: center;">
                                    </td>
                                    <td>
                                        {{--cu$--}}
                                        <input class="form-control txtComCUD class_merca" type="text"
                                               id="txtComCUD{{ $pFacturado->numPack }}"
                                               name="txtComCUD{{ $pFacturado->numPack }}"
                                               value="0" size="10"
                                               style="text-align: center;">
                                    </td>
                                    <td>
                                        {{--ct$--}}
                                        <input class="form-control txtComCTD class_merca" type="text"
                                               id="txtComCTD{{ $pFacturado->numPack }}"
                                               name="txtComCTD{{ $pFacturado->numPack }}"
                                               value="0" size="10"
                                               style="text-align: center;" readonly>
                                    </td>
                                    <td>
                                        {{--cus/--}}
                                        <input class="form-control txtComCUS class_merca" type="text"
                                               id="txtComCUS{{ $pFacturado->numPack }}"
                                               name="txtComCUS{{ $pFacturado->numPack }}"
                                               value="0"
                                               size="10"
                                               style="text-align: center;">
                                    </td>
                                    <td>
                                        {{--cts/--}}
                                        <input class="form-control txtComCTS class_merca" type="text"
                                               id="txtComCTS{{ $pFacturado->numPack }}"
                                               name="txtComCTS{{ $pFacturado->numPack }}"
                                               value="0"
                                               size="10"
                                               style="text-align: center;" readonly>
                                    </td>
                                    <td>
                                        {{--utilidad--}}
                                        <input class="form-control txtComUtilidad class_merca" type="text"
                                               id="txtComUtilidad{{ $pFacturado->numPack }}"
                                               name="txtComUtilidad{{ $pFacturado->numPack }}"
                                               value="0"
                                               size="10"
                                               style="text-align: center;" readonly>
                                    </td>
                                    <td>
                                        {{--margen--}}
                                        <input class="form-control txtComMargen class_merca" type="text"
                                               id="txtComMargen{{ $pFacturado->numPack }}"
                                               name="txtComMargen{{ $pFacturado->numPack }}"
                                               value="0"
                                               size="10"
                                               style="text-align: center;" readonly>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        {{--@if(isset($pFacturados))--}}
                            {{----}}
                        {{--@endif--}}
                        <tr id="addRow">
                            <td colspan="5" style="text-align: center">TOTAL</td>
                            <input type="hidden" id="montoTotalCotiFinalSIGV" name="montoTotalCotiFinalSIGV" value="">
                            <input type="hidden" id="montoTotalFactuSIGV" name="montoTotalFactuSIGV" value="">
                            <td><input class="form-control" id="txtComTotalCUD" name="txtComTotalCUD" type="text"style="text-align: center;" readonly></td>
                            <td><input class="form-control" id="txtComTotalCTD" name="txtComTotalCTD" type="text"style="text-align: center;" readonly></td>
                            <td><input class="form-control" id="txtComTotalCUS" name="txtComTotalCUS" type="text"style="text-align: center;" readonly></td>
                            <td><input class="form-control" id="txtComTotalCTS" name="txtComTotalCTS" type="text"style="text-align: center;" readonly></td>
                            <td><input class="form-control" id="txtComTotalUTILIDAD" name="txtComTotalUTILIDAD" type="text"style="text-align: center;" readonly></td>
                            <td><input class="form-control" id="txtComTotalMARGEN" name="txtComTotalMARGEN" type="text"style="text-align: center;" readonly></td>
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
                            <button type="submit" class="btn btn-success pull-right" id="btnFinalizar"
                                    name="btnFinalizar" style="width: 45%; margin-left: 2px;"><i class="fa fa-check"></i> Finalizar
                            </button>
                            {{--<a href="">MODAL</a>--}}
                            <button type="submit" class="btn btn-warning pull-right" id="btnGuardarMercaderia"
                                    name="btnGuardarMercaderia" style="width: 45%; margin-left: 2px;"><i class="fa fa-save"></i> Guardar
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
            cotizacion();
            facturacion();
            compras();
            //calculos en tiempo real de las compras
            $('.class_merca').keyup(function () {
                var cc = parseInt($("#cantMerca").val());
                var dolar = parseFloat($('#txt_dolar').val());
                var igv = parseFloat($('#txt_igv').val());
                for (var i = 1; i <= cc; i++) {
                    if ($(this).attr('name') === 'txt_canti_merca' + i || $(this).attr('name') === 'txtComCUS' + i || $(this).attr('name') === 'txtComCUD' + i) {
                        //selectores para setear datos
                        var cantidad = "#txt_canti_merca" + i;
                        var cud = "#txtComCUD" + i;
                        //selectores para mostrar datos
                        var ctd = "#txtComCTD" + i;
                        var cus = "#txtComCUS" + i;
                        var cts = "#txtComCTS" + i;
                        var precioFacturado = "#txtFacTOTAL" + i;
                        var utilidad = "#txtComUtilidad" + i;
                        var margen = "#txtComMargen" + i;

                        //variables
                        var cant = parseFloat($(cantidad).val());
                        var costo_dolares = parseFloat($(cud).val());
                        var pFact = parseFloat($(precioFacturado).val());

                        var costoTD = (cant*costo_dolares + ((cant*costo_dolares)*igv) ).toFixed(2);
                        var costoUS = (costo_dolares * dolar).toFixed(2);
                        var costoCT = ((costoUS * cant)+((costoUS * cant)*igv)).toFixed(2);
                        var uti = (pFact - costoCT).toFixed(2);
                        var marg = ((uti*100)/pFact).toFixed(2);

                        $(ctd).val(costoTD);
                        $(cus).val(costoUS);
                        $(cts).val(costoCT);
                        $(utilidad).val(uti);
                        $(margen).val(marg/cc);

                        compras();
//                        calculosTotales();
                    }
                }
            });
        });

        //COTIZACION
        function cotizacion(){
            var PUS = 0.0;
            var PTS = 0.0;
            var UTIL = 0.0;
            var MARGEN = 0.0;
            var CUD = 0.0;
            var CTD = 0.0;
            var CUS = 0.0;
            var CTS = 0.0;

//            P.U.S/
            $('.txtCotPUS').each(function(){
                var monto = parseFloat($(this).val());
                PUS += monto;
            });
            $('#txtCotTotalPUS').val(parseFloat(PUS).toFixed(2));

            //PTS
            $('.txtCotPTS').each(function(){
                var montoPTS = parseFloat($(this).val());
                PTS += montoPTS;
            });
            $('#txtCotTotalPTS').val(parseFloat(PTS).toFixed(2));

            //UTIL
            $('.txtCotUTIL').each(function(){
                var montoUTIL = parseFloat($(this).val());
                UTIL += montoUTIL;
            });
            $('#txtCotTotalUTIL').val(parseFloat(UTIL).toFixed(2));

            //MARGEN
            $('.txtCotMARGEN').each(function(){
                var montoMARGEN = parseFloat($(this).val());
                MARGEN += montoMARGEN;
            });
            $('#txtCotTotalMARGEN').val(parseFloat(MARGEN).toFixed(2));

            //CUD
            $('.txtCotCUD').each(function(){
                var montoCUD = parseFloat($(this).val());
                CUD += montoCUD;
            });
            $('#txtCotTotalCUD').val(parseFloat(CUD).toFixed(2));

            //CTD
            $('.txtCotCTD').each(function(){
                var montoCTD = parseFloat($(this).val());
                CTD += montoCTD;
            });
            $('#txtCotTotalCTD').val(parseFloat(CTD).toFixed(2));

            //CUS
            $('.txtCotCUS').each(function(){
                var montoCUS = parseFloat($(this).val());
                CUS += montoCUS;
            });
            $('#txtCotTotalCUS').val(parseFloat(CUS).toFixed(2));

            //CTS
            $('.txtCotCTS').each(function(){
                var montoCTS= parseFloat($(this).val());
                CTS += montoCTS;
            });
            $('#txtCotTotalCTS').val(parseFloat(CTS).toFixed(2));


            //setear el monto de la cotizacion para registrarlo en la tabla tcotizacionfinal
            $('#montoTotalCotiFinalSIGV').val(PTS);
        }

        function facturacion(){
            var PUS = 0.0;
            var DCTOS = 0.0;
            var TOTAL = 0.0;

            //PUS
            $('.txtFacPUS').each(function(){
                var montoPUS= parseFloat($(this).val());
                PUS += montoPUS;
            });
            $('#txtFacTotalPUS').val(parseFloat(PUS).toFixed(2));

            //DCTOS
            $('.txtFacDCTOS').each(function(){
                var montoDCTOS= parseFloat($(this).val());
                DCTOS += montoDCTOS;
            });
            $('#txtFacTotalDCTOS').val(parseFloat(DCTOS).toFixed(2));

            //TOTAL
            $('.txtFacTOTAL').each(function(){
                var montoTOTAL= parseFloat($(this).val());
                TOTAL += montoTOTAL;
            });
            $('#txtFacTotalTOTAL').val(parseFloat(TOTAL).toFixed(2));

            $('#montoTotalFactuSIGV').val(TOTAL);
        }

        function compras(){
            var CUD = 0.0;
            var CTD = 0.0;
            var CUS = 0.0;
            var CTS = 0.0;
            var UTILIDAD = 0.0;
            var MARGEN = 0.0;

            //CUD
            $('.txtComCUD').each(function(){
                var montoCUD= parseFloat($(this).val());
                CUD += montoCUD;
            });
            $('#txtComTotalCUD').val(parseFloat(CUD).toFixed(2));

            //CTD
            $('.txtComCTD').each(function(){
                var montoCTD= parseFloat($(this).val());
                CTD += montoCTD;
            });
            $('#txtComTotalCTD').val(parseFloat(CTD).toFixed(2));

            //CUS
            $('.txtComCUS').each(function(){
                var montoCUS = parseFloat($(this).val());
                CUS += montoCUS;
            });
            $('#txtComTotalCUS').val(parseFloat(CUS).toFixed(2));

            //CTS
            $('.txtComCTS').each(function(){
                var montoCTS = parseFloat($(this).val());
                CTS += montoCTS;
            });
            $('#txtComTotalCTS').val(parseFloat(CTS).toFixed(2));

            //UTILIDAD
            $('.txtComUtilidad').each(function(){
                var montoUTILIDAD = parseFloat($(this).val());
                UTILIDAD += montoUTILIDAD;
            });
            $('#txtComTotalUTILIDAD').val(parseFloat(UTILIDAD).toFixed(2));

            //MARGEN
            $('.txtComMargen').each(function(){
                var montoMARGEN = parseFloat($(this).val());
                MARGEN += montoMARGEN;
            });
            $('#txtComTotalMARGEN').val(parseFloat(MARGEN).toFixed(2));

        }

//        function calculosTotales(){
//
//            var totalDolarProductos = parseFloat($('#txtTotalDolarSIN').val());
//            var totalDolarMerca = parseFloat($('#txtTotalDolarMerca').val());
//
//            var txtTotalCostoProd = parseFloat($('#txtTotalCostoProd').val());
//            var txtTotalMerca = parseFloat($('#txtTotalMerca').val());
//
//            var txtUtilidadProd = parseFloat($('#txtUtilidadProd').val());
//            var txtTotalUtiMerca = parseFloat($('#txtTotalUtiMerca').val());
//
//            $('#txtMontoTotalDolar').val((totalDolarProductos-totalDolarMerca).toFixed(2));
//            $('#txtMontoTotalSoles').val((txtTotalCostoProd-txtTotalMerca).toFixed(2));
//            $('#txtMontoTotalUti').val((txtUtilidadProd-txtTotalUtiMerca).toFixed(2));
//        }

    </script>
@endsection
