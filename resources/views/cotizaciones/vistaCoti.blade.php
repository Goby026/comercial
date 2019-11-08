@extends ('layouts.admin')
@section ('contenido')
    <style>
        .panel-produc {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            padding: 2px;
        }
        .cabeceras td{
            border: 1px solid #8c8c8c;
            text-align: center;
        }

        .descripcion{
            text-align: center;
            background: #f0ad4e;
            border: 1px solid #8c8c8c;
            text-align: center;
            color: lightcyan;
        }

        .costo{
            text-align: center;
            background: #1b7e5a;
            border: 1px solid #8c8c8c;
            text-align: center;
            color: lightcyan;
        }

        .venta{
            text-align: center;
            background: #0d6aad;
            border: 1px solid #8c8c8c;
            text-align: center;
            color: lightcyan;
        }
    </style>
    <div class="row">
        <div class="col-md-12">
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ url('cotizaciones') }}">Cotizaciones</a>
                    </li>
                    <li class="breadcrumb-item active">
                        Costeo
                    </li>
                </ol>
            </nav>
        </div>
    </div>
    {{-- cargar cambio y monto de igv --}}
    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h1>
                    Asunto
                    <small>{{ $cotizacion->asuntoCoti }}</small>
                </h1>
            </div>
        </div>

    </div>

    <div id="components-demo">
        <tabla coti="{{$cotizacion}}"></tabla>
    </div>

    <script src="{{ asset('js/vue-costeo/costeoTabla.js') }}"></script>
{{--    <div class="row">--}}
{{--        <div class="col-md-12 table-responsive">--}}
{{--            <form action="" method="POST">--}}
{{--                {{Form::token()}}--}}
{{--                <table>--}}
{{--                    <thead class="head_datos">--}}
{{--                    <th width="100" style="text-align: center;">#Coti</th>--}}
{{--                    <th width="100" style="text-align: center;">Costeos</th>--}}
{{--                    <th width="100" style="text-align: center;">Cambio</th>--}}
{{--                    <th width="100" style="text-align: center;">Igv</th>--}}
{{--                    </thead>--}}
{{--                    <tbody>--}}
{{--                    <td><input id="txt_numCoti" name="txt_numCoti" type="text" class="form-control"--}}
{{--                               style="text-align: center;" value="{{$cotizacion->numCoti}}" readonly></td>--}}
{{--                    <td><input id="txt_total_costeos" name="txt_total_costeos" type="text" class="form-control"--}}
{{--                               style="text-align: center;" value="{{ count($productos) }}" readonly>--}}
{{--                    </td>--}}
{{--                    <td><input id="txt_dolar" name="txt_dolar" type="text" class="form-control"--}}
{{--                               style="text-align: center;" value="3.3" readonly></td>--}}
{{--                    <td><input id="txt_igv" name="txt_igv" type="text" class="form-control" style="text-align: center;"--}}
{{--                               value="0.18" readonly></td>--}}
{{--                    </tbody>--}}
{{--                </table>--}}
{{--                <div class="row">--}}
{{--                    <button class="btn btn-success btn-sm pull-right add-modal-newItem" type="button"--}}
{{--                            style="margin-right: 30px;"><i class="fa fa-plus-square"></i>&nbsp;&nbsp; Agregar costeo--}}
{{--                    </button>--}}
{{--                </div>--}}
{{--            </form>--}}
{{--            <hr>--}}
{{--            <form action="{{ url('updateCosteo', $cotizacion->codiCoti) }}" method="POST">--}}
{{--                {{Form::token()}}--}}

{{--                <input type="hidden" name="txt_codiCoti" value="{{ $cotizacion->codiCoti }}">--}}
{{--                <table class="tbl-costeo">--}}
{{--                    <thead class="head_costeo">--}}
{{--                    <tr>--}}
{{--                        <th style="text-align: center;">--}}
{{--                            DETALLE--}}
{{--                        </th>--}}
{{--                        <th style="text-align: center;">--}}
{{--                            M. COSTO--}}
{{--                        </th>--}}
{{--                        <th style="text-align: center;">--}}
{{--                            CAN--}}
{{--                        </th>--}}
{{--                        <th style="text-align: center;">--}}
{{--                            C.U $ SIN--}}
{{--                        </th>--}}
{{--                        <th style="text-align: center;">--}}
{{--                            C.U $--}}
{{--                        </th>--}}
{{--                        <th style="text-align: center;">--}}
{{--                            TOTAL--}}
{{--                        </th>--}}
{{--                        <th style="text-align: center;">--}}
{{--                            C.U S/--}}
{{--                        </th>--}}
{{--                        <th style="text-align: center;">--}}
{{--                            TOTAL--}}
{{--                        </th>--}}
{{--                        <th style="text-align: center;">--}}
{{--                            P.U. S/--}}
{{--                        </th>--}}
{{--                        <th style="text-align: center;">--}}
{{--                            TOTAL--}}
{{--                        </th>--}}
{{--                        <th style="text-align: center;">--}}
{{--                            UTILIDAD--}}
{{--                        </th>--}}
{{--                        <th style="text-align: center;">--}}
{{--                            M. VENTA--}}
{{--                        </th>--}}
{{--                    </tr>--}}
{{--                    </thead>--}}
{{--                    <tbody>--}}
{{--                    @foreach ($productos as $producto)--}}
{{--                        <tr>--}}
{{--                            <td>--}}
{{--                                <div style="margin-left: 5px;">--}}
{{--                                    @if($producto->itemCosteo != '.')--}}
{{--                                        {{ $producto->itemCosteo }}--}}
{{--                                    @else--}}
{{--                                        {{ $producto->nombreProducProveedor }}--}}
{{--                                    @endif--}}
{{--                                </div>--}}
{{--                            </td>--}}
{{--                            <td>--}}
{{--                                <input class="form-control" type="text" id="txt_margen_cu_soles{{ $producto->numPack }}"--}}
{{--                                       name="txt_margen_cu_soles{{ $producto->numPack }}"--}}
{{--                                       value="{{ $producto->margenCoti }}" style="text-align: center;">--}}
{{--                            </td>--}}
{{--                            <td>--}}
{{--                                <input class="form-control" type="text" id="txt_cantidad{{ $producto->numPack }}"--}}
{{--                                       name="txt_cantidad{{ $producto->numPack }}" value="{{ $producto->cantiCoti }}"--}}
{{--                                       size="2" style="text-align: center;">--}}
{{--                            </td>--}}
{{--                            <td>--}}
{{--                                <input class="form-control" type="text" id="txt_cus_dolar_sin{{ $producto->numPack }}"--}}
{{--                                       name="txt_cus_dolar_sin{{ $producto->numPack }}"--}}
{{--                                       value="{{ number_format($producto->precioProducDolar, 2, '.', '') }}" size="10"--}}
{{--                                       style="text-align: center;">--}}
{{--                            </td>--}}
{{--                            <td>--}}
{{--                                <input class="form-control" type="text" id="txt_cus_dolar{{ $producto->numPack }}"--}}
{{--                                       name="txt_cus_dolar{{ $producto->numPack }}"--}}
{{--                                       value="{{ number_format($producto->costoUniIgv, 2, '.', '') }}" size="10"--}}
{{--                                       style="text-align: center;" readonly>--}}
{{--                            </td>--}}
{{--                            <td>--}}
{{--                                <input class="form-control" type="text" id="txt_total_dolar{{ $producto->numPack }}"--}}
{{--                                       name="txt_total_dolar{{ $producto->numPack }}"--}}
{{--                                       value="{{ number_format($producto->costoTotalIgv, 2, '.', '') }}" size="10"--}}
{{--                                       style="text-align: center;" readonly>--}}
{{--                            </td>--}}
{{--                            <td>--}}
{{--                                <input class="form-control" type="text" id="txt_cus_soles{{ $producto->numPack }}"--}}
{{--                                       name="txt_cus_soles{{ $producto->numPack }}"--}}
{{--                                       value="{{ number_format($producto->costoUniSolesIgv, 2, '.', '') }}" size="10"--}}
{{--                                       style="text-align: center;" readonly>--}}
{{--                            </td>--}}
{{--                            <td>--}}
{{--                                <input class="form-control" type="text" id="txt_total_soles{{ $producto->numPack }}"--}}
{{--                                       name="txt_total_soles{{ $producto->numPack }}"--}}
{{--                                       value="{{ number_format($producto->costoTotalSolesIgv, 2, '.', '') }}" size="10"--}}
{{--                                       style="text-align: center;" readonly>--}}
{{--                            </td>--}}
{{--                            <td>--}}
{{--                                <input class="form-control" type="text" id="txt_pu_soles{{ $producto->numPack }}"--}}
{{--                                       name="txt_pu_soles{{ $producto->numPack }}"--}}
{{--                                       value="{{ number_format($producto->precioUniSoles, 2, '.', '') }}"--}}
{{--                                       size="10" style="text-align: center;">--}}
{{--                            </td>--}}
{{--                            <td>--}}
{{--                                <input class="form-control" type="text" id="txt_pu_total_soles{{ $producto->numPack }}"--}}
{{--                                       name="txt_pu_total_soles{{ $producto->numPack }}"--}}
{{--                                       value="{{ number_format($producto->precioTotal, 2, '.', '') }}"--}}
{{--                                       size="10" style="text-align: center;" readonly>--}}
{{--                            </td>--}}
{{--                            <td>--}}
{{--                                <input class="form-control" type="text" id="txt_utilidad_u{{ $producto->numPack }}"--}}
{{--                                       name="txt_utilidad_u{{ $producto->numPack }}"--}}
{{--                                       value="{{ number_format($producto->utiCoti, 2, '.', '')  }}" size="10"--}}
{{--                                       style="text-align: center;" readonly>--}}
{{--                            </td>--}}
{{--                            <td>--}}
{{--                                <input class="form-control" type="text" id="txt_margen_u{{ $producto->numPack }}"--}}
{{--                                       name="txt_margen_u{{ $producto->numPack }}"--}}
{{--                                       value="{{ number_format($producto->margenVentaCoti, 2, '.', '')  }}" size="10"--}}
{{--                                       style="text-align: center;" readonly>--}}
{{--                            </td>--}}
{{--                        </tr>--}}
{{--                    @endforeach--}}
{{--                    <tr>--}}
{{--                        <td colspan="9"></td>--}}
{{--                        <td><input class="form-control" type="text" id="txt_ventaTotal" name="txt_ventaTotal"--}}
{{--                                   style="text-align: center;" value="{{ $costeo->totalVentaSoles }}"></td>--}}
{{--                        <td><input class="form-control" type="text" id="txt_utilidadTotal" name="txt_utilidadTotal"--}}
{{--                                   style="text-align: center;" value="{{ $costeo->utilidadVentaSoles }}"></td>--}}
{{--                        <td><input class="form-control" type="text" id="txt_margenTotal" name="txt_margenTotal"--}}
{{--                                   style="text-align: center;" value="{{ $costeo->margenVenta }}"></td>--}}
{{--                    </tr>--}}

{{--                    </tbody>--}}
{{--                </table>--}}
{{--                <br>--}}
{{--                <div class="row">--}}
{{--                    --}}{{--<button type="submit" class="btn btn-warning btn-sm pull-right" style="margin-right: 30px;"><i--}}
{{--                    --}}{{--class="fa fa-floppy-o"></i> Guardar--}}
{{--                    --}}{{--</button>--}}
{{--                </div>--}}
{{--            </form>--}}
{{--        </div>--}}
{{--    </div>--}}



    <!-- Modal para confirmar nuevo item -->
    <div id="addModal-newItem" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">¿Desea agregar otro item?</label>
                    </div>
                    <div class="modal-footer-newItem">
                        <a href="#" class="btn btn-success add-newItem" data-dismiss="modal">
                            <span id="" class='fa fa-check'></span> Continuar
                        </a>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">
                            <span class='fa fa-remove'></span> Cerrar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

