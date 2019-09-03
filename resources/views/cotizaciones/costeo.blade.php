<style type="text/css">
    .btn-design {
        display: none;
        color: #000;
        position: fixed;
        bottom: 100px;
        right: 0;
    }

    .btn-cot {
        width: 60px;
        padding: 20px;
        font-size: 20px;
        text-align: center;
    }

    /*
    Full screen Modal
    */
    .fullscreen-modal .modal-dialog {
        margin: 0;
        margin-right: auto;
        margin-left: auto;
        width: 100%;
    }

    @media (min-width: 768px) {
        .fullscreen-modal .modal-dialog {
            width: 750px;
        }
    }

    @media (min-width: 992px) {
        .fullscreen-modal .modal-dialog {
            width: 970px;
        }
    }

    @media (min-width: 1200px) {
        .fullscreen-modal .modal-dialog {
            width: 1170px;
        }
    }
</style>

@if(isset($coti_continue))
    {!!Form::model($coti_continue,['method'=>'PATCH','route'=>['cotizaciones.update',$coti_continue],'name'=>'frm_coti','files'=>'true'])!!}
@else
    {!!Form::model($cotizacion,['method'=>'PATCH','route'=>['cotizaciones.update',$cotizacion],'name'=>'frm_coti','files'=>'true'])!!}
@endif
{{Form::token()}}

@include('cotizaciones.clienteAtencionRef')
<br>
<main id="costeo">
    <div class="container">
        <div class="row">
            {{--    <div class="col-md-12">--}}
            <div class="col-md-2">
                Dolar: <br>
                <button type="button" class="btn btn-info btn-block" v-on:click="setDolar">{{ $dolar->dolarVenta }}</button>
                {{--            <input type="text" id="txt_dolar" name="txt_dolar" value="{{ $dolar->dolarVenta }}"--}}
                {{--                          class=" form-control" style="text-align: center;">--}}
                <input type="hidden" name="txt_dolar" value="{{ $dolar->codiDolar }}">
            </div>
            <div class="col-md-2">
                IGV:
                <button type="button" class="btn btn-info btn-block">{{ $igv->valorIgv/100 }}</button>
                <input type="hidden" name="txt_igv" value="{{ $igv->codiIgv }}">
            </div>
            <div class="col-md-2">
                Fecha: <input type="date" class="form-control" id="txtFecha" name="txtFecha"
                              value="{{ $coti_continue->fechaCoti }}">
            </div>
            <div class="col-md-4 radios">
                <br>
                @if($costeo->tipoCosteo == 0)
                    <label for="cb_producto" style="cursor: pointer; font-size: 16px;">Producto</label>
                    <input type="radio" name="cb_option" id="cb_producto" checked value="0">&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <label for="cb_servicio" style="cursor: pointer; font-size: 16px;">Servicio</label>
                    <input type="radio" name="cb_option" id="cb_servicio" value="1">
                @elseif($costeo->tipoCosteo == 1)
                    <label for="cb_producto" style="cursor: pointer; font-size: 16px;">Producto</label>
                    <input type="radio" name="cb_option" id="cb_producto" value="0">&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;
                    <label for="cb_servicio" style="cursor: pointer; font-size: 16px;">Servicio</label>
                    <input type="radio" name="cb_option" id="cb_servicio" checked value="1">
                @else{
                <label for="cb_producto" style="cursor: pointer; font-size: 16px;">Producto</label>
                <input type="radio" name="cb_option" id="cb_producto" value="0">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;
                <label for="cb_servicio" style="cursor: pointer; font-size: 16px;">Servicio</label>
                <input type="radio" name="cb_option" id="cb_servicio" value="1">
                }
                @endif
            </div>
            <div class="col-md-2">

            </div>
        </div>
    </div>
    <br>

    <div class="container-fluid animated fadeIn">

        @if(isset($coti_continue))
            @if (count($costeosItems)>0)
                <div class="row">
                    <div class="col-md-12">
                        <label>PRODUCTOS</label>
                        <span class="pull-right">TOTAL COSTEOS <input type="text" id="txt_total_costeos"
                                                                      name="txt_total_costeos"
                                                                      v-model="totalCosteos" size="5"
                                                                      style="text-align: center;"></span>
                    </div>
                </div>

                <div class="row">
                    <input type="hidden" name="_coti" value="{{ $cotizacion }}">

                    <section v-for="costeo in costeos">
                        <div v-if="costeo.tipoCosteo === 0">
                            <div v-for="item in prods" v-if="item.codiCosteo == costeo.codiCosteo"
                                 class="panel panel-primary panel-produc panel-costeo">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                Producto
                                                <input type="text" name="txt_new_product" id="txtProducto"
                                                       class="form-control" v-model="item.itemCosteo"
                                                       v-on:blur="handleBlur(item)">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                Proveedor
                                                <div class="input-group">
                                                    <select id="txt_proveedor"
                                                            name="txt_proveedor"
                                                            class="form-control">
                                                        <option v-for="proveedor in proveedores"
                                                                v-model:value="proveedor.codiProveedor"
                                                                :selected="proveedor.codiProveedor == item.codiProveedor">
                                                            @{{ proveedor.nombreProveedor }}
                                                        </option>
                                                    </select>
                                                    <span class="input-group-btn">
                                                <button class="btn btn-success" type="button">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                Cod. Interno
                                                <input type="text" name="txt_cod_interno"
                                                       class="form-control" v-model="item.codInterno"
                                                       v-on:blur="handleBlur(item)">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                Cod. Proveedor
                                                <input type="text" name="txt_cod_proveedor"
                                                       class="form-control" v-model="item.codProveedor"
                                                       v-on:blur="handleBlur(item)">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Descripción</label>
                                                {{--                                        <textarea id="txt_descripcion" class="form-control txt_descripcion"--}}
                                                {{--                                                  name="txt_descripcion" v-html="costeo.descCosteoItem">--}}
                                                {{--                                        </textarea>--}}
                                                <textarea v-tinymce :id="item.idCosteoItem" v-model="item.descCosteoItem" style="width: 100% !important;">
                                                    @{{ item.descCosteoItem }}
                                                </textarea>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="row table-responsive">
                                        <div class="col-md-8">
                                            <div class="panel panel-danger">
                                                <div class="panel-heading">
                                                    <h3 class="panel-title">Costeo Perú Data</h3>
                                                </div>
                                                <div class="panel-body">
                                                    <table style="font-size: 10px;">
                                                        <thead>
                                                        <th>MARGEN C.U. S/.</th>
                                                        <th>Cantidad</th>
                                                        <th>C. U. $ SIN</th>
                                                        <th>C. U. $</th>
                                                        <th>TOTAL $</th>
                                                        <th>C. U. S/.</th>
                                                        <th>TOTAL S/.</th>
                                                        <th>P. U. S/.</th>
                                                        </thead>
                                                        <tbody>
                                                        <tr class="fila">
                                                            <td>
                                                                <input type="text"
                                                                       class="form-control cost_mod mCosto"
                                                                       name="txt_margen_cu_soles"
                                                                       style="padding: 0; margin: 0; width: 100%; text-align: center;"
                                                                       v-model="item.margenCoti"
                                                                       v-on:keyup="operar(item)"
                                                                       v-on:blur="handleBlur(item)"></td>
                                                            <td>
                                                                <input type="text" id="txt_cantidad"
                                                                       class="form-control cost_mod"
                                                                       name="txt_cantidad"
                                                                       style="width: 100%; text-align: center;"
                                                                       v-model="item.cantiCoti"
                                                                       v-on:keyup="operar(item)"
                                                                       v-on:blur="handleBlur(item)"></td>
                                                            <td>
                                                                <input type="text"
                                                                       id="txt_cus_dolar_sin"
                                                                       class="form-control cost_mod"
                                                                       name="txt_cus_dolar_sin"
                                                                       style="width: 100%; text-align: center;"
                                                                       v-model="item.precioProducDolar"
                                                                       v-on:keyup="operar(item)"
                                                                       v-on:blur="handleBlur(item)"></td>
                                                            <td>
                                                                <input type="text" readonly
                                                                       id="txt_cus_dolar"
                                                                       class="form-control"
                                                                       name="txt_cus_dolar"
                                                                       style="width: 100%; text-align: center;"
                                                                       v-model="item.costoUniIgv"></td>
                                                            <td>
                                                                <input type="text" readonly
                                                                       id="txt_total_dolar"
                                                                       class="form-control costoTotalDolares"
                                                                       name="txt_total_dolar"
                                                                       style="width: 100%; text-align: center;"
                                                                       v-model="item.costoTotalIgv"></td>
                                                            <td>
                                                                <input type="text" readonly
                                                                       id="txt_cus_soles"
                                                                       class="form-control"
                                                                       name="txt_cus_soles"
                                                                       style="width: 100%; text-align: center;"
                                                                       v-model="item.costoUniSolesIgv"></td>
                                                            <td>
                                                                <input type="text" readonly
                                                                       id="txt_total_soles"
                                                                       class="form-control totalCostos"
                                                                       name="txt_total_soles"
                                                                       style="width: 100%; text-align: center;"
                                                                       v-model="item.costoTotalSolesIgv"></td>
                                                            <td>
                                                                <input type="text" id="txt_pu_soles"
                                                                       class="form-control cost_mod"
                                                                       name="txt_pu_soles"
                                                                       style="width: 100%; text-align: center;"
                                                                       v-model="item.precioUniSoles"
                                                                       v-on:keyup="operar_pus(item)"
                                                                       v-on:blur="handleBlur(item)">
                                                            </td>
                                                        </tr>

                                                        </tbody>
                                                    </table>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="panel panel-info">
                                                <div class="panel-heading">
                                                    <h3 class="panel-title">Precio cliente</h3>
                                                </div>
                                                <div class="panel-body">
                                                    <div class="col-md-12">
                                                        <table style="font-size: 10px;">
                                                            <thead>
                                                            <th>TOTAL</th>
                                                            <th>UTILIDAD</th>
                                                            <th>MARGEN</th>
                                                            </thead>
                                                            <tbody>
                                                            <tr>
                                                                <td>
                                                                    <input type="text" readonly
                                                                           id="txt_pu_total_soles"
                                                                           class="form-control calCot"
                                                                           name="txt_pu_total_soles"
                                                                           style="width: 100%; text-align: center;"
                                                                           v-model="item.precioTotal">
                                                                </td>
                                                                <td>
                                                                    <input type="text" readonly
                                                                           id="txt_utilidad_u"
                                                                           class="form-control calUti"
                                                                           name="txt_utilidad_u"
                                                                           style="width: 100%; text-align: center;"
                                                                           v-model="item.utiCoti">
                                                                </td>
                                                                <td>
                                                                    <input type="text" readonly
                                                                           id="txt_margen_u"
                                                                           class="form-control calMargen"
                                                                           name="txt_margen_u"
                                                                           style="width: 100%; text-align: center;"
                                                                           v-model="item.margenVentaCoti">
                                                                </td>
                                                            </tr>

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <a id="modal-"
                                       href="#modal-container-" role="button"
                                       class="btn btn-danger pull-right" data-toggle="modal"><i class="fa fa-trash"></i>
                                        Eliminar</a>
                                </div>
                            </div>
                        </div>
                        <div v-if="costeo.tipoCosteo === 1" class="panel panel-primary panel-produc panel-costeo">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <textarea v-tinymce :id="costeo.codiCosteo" style="width: 100% !important;">
                                                    @{{ costeo.descCosteo }}
                                        </textarea>
                                    </div>
                                </div>
                                <div class="row table-responsive">
                                    <div class="col-md-12">
                                        <button type="button" class="btn btn-primary btn-xs pull right"
                                                v-on:click="addItemCosteo(costeo.codiCosteo)"><i class="fa fa-plus"></i>
                                        </button>
                                        <table>
                                            <thead>
                                            <tr>
{{--                                                <th>PROVEEDOR</th>--}}
                                                <th>COD-PROV</th>
                                                <th>COD-INT</th>
                                                <th>DETALLE</th>
                                                <th>CANT</th>
                                                <th>MARG CU$</th>
                                                <th>CU $ SIN</th>
                                                <th>CU $</th>
                                                <th>TOTAL $</th>
                                                <th>CU S/.</th>
                                                <th>TOTAL S/.</th>
                                                <th>PU S/.</th>
                                                <th>TOTAL</th>
                                                <th>UTILIDAD</th>
                                                <th>MARGEN</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <section>
                                                <tr v-for="item in items" v-if="item.codiCosteo == costeo.codiCosteo">
{{--                                                    <td>--}}
{{--                                                        <select @change="saveIdProveedor($event, item.idCosteoItem)" v-model="item.nombreProveedor">--}}
{{--                                                            <option v-for="proveedor in proveedores" :value="proveedor.codiProveedor">--}}
{{--                                                                @{{ proveedor.nombreProveedor }}--}}
{{--                                                            </option>--}}
{{--                                                        </select>--}}
{{--                                                    </td>--}}
                                                    <td>
                                                        <input type="text" class="form-control"
                                                               v-model="item.codProveedor"
                                                               v-on:blur="handleBlur(item)">
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control"
                                                               v-model="item.codInterno"
                                                               v-on:blur="handleBlur(item)">
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control txtProducto"
                                                               v-model="item.descCosteoItem"
                                                               v-on:blur="handleBlur(item)">
                                                    </td>
                                                    <td>
                                                        <input type="text" id="txt_cantidad"
                                                               class="form-control cost_mod"
                                                               name="txt_cantidad"
                                                               style="width: 100%; text-align: center;"
                                                               v-on:keyup="operar(item)"
                                                               v-on:blur="handleBlur(item)"
                                                               v-model="item.cantiCoti"></td>
                                                    <td>
                                                        <input type="text"
                                                               class="form-control cost_mod mCosto"
                                                               name="txt_margen_cu_soles"
                                                               style="padding: 0; margin: 0; width: 100%; text-align: center;"
                                                               v-on:keyup="operar(item)"
                                                               v-on:blur="handleBlur(item)"
                                                               v-model="item.margenCoti"></td>
                                                    <td>
                                                        <input type="text"
                                                               id="txt_cus_dolar_sin"
                                                               class="form-control cost_mod"
                                                               name="txt_cus_dolar_sin"
                                                               style="width: 100%; text-align: center;"
                                                               v-on:keyup="operar(item)"
                                                               v-on:blur="handleBlur(item)"
                                                               v-model="item.precioProducDolar"></td>
                                                    <td>
                                                        <input type="text" readonly
                                                               id="txt_cus_dolar"
                                                               class="form-control"
                                                               name="txt_cus_dolar"
                                                               style="width: 100%; text-align: center;"
                                                               v-model="item.costoUniIgv"></td>
                                                    <td>
                                                        <input type="text" readonly
                                                               id="txt_total_dolar"
                                                               class="form-control costoTotalDolares"
                                                               name="txt_total_dolar"
                                                               style="width: 100%; text-align: center;"
                                                               v-model="item.costoTotalIgv"></td>
                                                    <td>
                                                        <input type="text" readonly
                                                               id="txt_cus_soles"
                                                               class="form-control"
                                                               name="txt_cus_soles"
                                                               style="width: 100%; text-align: center;"
                                                               v-model="item.costoUniSolesIgv"></td>
                                                    <td>
                                                        <input type="text" readonly
                                                               id="txt_total_soles"
                                                               class="form-control totalCostos"
                                                               name="txt_total_soles"
                                                               style="width: 100%; text-align: center;"
                                                               v-model="item.costoTotalSolesIgv"></td>
                                                    <td>
                                                        <input type="text" id="txt_pu_soles"
                                                               class="form-control cost_mod"
                                                               name="txt_pu_soles"
                                                               style="width: 100%; text-align: center;"
                                                               v-model="item.precioUniSoles"
                                                               v-on:keyup="operar_pus(item)"
                                                               v-on:blur="handleBlur(item)">
                                                    </td>
                                                    <td>
                                                        <input type="text" readonly
                                                               id="txt_pu_total_soles"
                                                               class="form-control calCot"
                                                               name="txt_pu_total_soles"
                                                               style="width: 100%; text-align: center;"
                                                               v-model="item.precioTotal">
                                                    </td>
                                                    <td>
                                                        <input type="text" readonly
                                                               id="txt_utilidad_u"
                                                               class="form-control calUti"
                                                               name="txt_utilidad_u"
                                                               style="width: 100%; text-align: center;"
                                                               v-model="item.utiCoti">
                                                    </td>
                                                    <td>
                                                        <input type="text" readonly
                                                               id="txt_margen_u"
                                                               class="form-control calMargen"
                                                               name="txt_margen_u"
                                                               style="width: 100%; text-align: center;"
                                                               v-model="item.margenVentaCoti">
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-danger btn-xs"
                                                                v-on:click="deleteItem(item.idCosteoItem)"><i
                                                                    class="fa fa-minus"></i></button>
                                                    </td>
                                                </tr>
                                            </section>
                                            <tr>
                                                <td>
                                                    Cantidad
                                                </td>
                                                <td>
                                                    <input type="number" class="form-control" v-model="cantidad">
                                                </td>
                                                <td colspan="6">
                                                    &nbsp;
                                                </td>
                                                <td><input style="width: 100%; text-align: center; padding: 0; margin: 0;" type="text" value="200" class="form-control"></td>
                                                <td><input style="width: 100%; text-align: center; padding: 0; margin: 0;" type="text" value="200" class="form-control"></td>
                                                <td><input style="width: 100%; text-align: center; padding: 0; margin: 0;" type="text" value="200" class="form-control"></td>
                                                <td><input style="width: 100%; text-align: center; padding: 0; margin: 0;" type="text" value="200" class="form-control"></td>
                                                <td><input style="width: 100%; text-align: center; padding: 0; margin: 0;" type="text" value="200" class="form-control"></td>
                                                <td><input style="width: 100%; text-align: center; padding: 0; margin: 0;" type="text" value="200" class="form-control"></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal para eliminar item -->
                            <div class="modal fade" id="modal-container-" role="dialog"
                                 aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="myModalLabel">
                                                ¿Desea eliminar el costeo?
                                                <button type="button" class="close" data-dismiss="modal">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </h4>
                                        </div>
                                        <div class="modal-body">
                                            <center>
                                                <i class="fa fa-warning" style="font-size:48px;color:red;"></i>
                                            </center>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-success del-delItem"
                                                    id="" data-dismiss="modal">
                                                Confirmar
                                            </button>
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">
                                                Cancelar
                                            </button>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </section>
                </div>
                <div class="btn-group" style="margin-left: 10px; margin-bottom: 10px;">
                    <button type="button" class="btn btn-primary btn-lg dropdown-toggle" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-desktop"></i> Agregar <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="btn btn-warning" v-on:click="newCosteo(0)">Producto</a></li>
                        <li><a class="btn btn-info" v-on:click="newCosteo(1)">Kit</a></li>
                    </ul>
                </div>

                <div class="row">
                    <input type="hidden" name="totalCostoDolar" id="totalCostoDolar" class="totalCostoDolar"
                           value="">
                    <input type="hidden" name="totalCosto" id="totalCosto" class="totalCosto" value="">
                    <input type="hidden" name="margenCosto" id="margenCosto" class="margenCosto" value="">
                    <input type="hidden" name="_costeo" id="_costeo" value="{{ $costeo->codiCosteo }}">
                    <div class="col-md-2">
                        <label for="">TIPO DE MONEDA</label>
                        <select id="cmb_currency" name="cmb_currency" class="form-control">
                            @if($costeo->currency == 0)
                                <option value="0" selected>SOLES</option>
                                <option value="1">DOLARES</option>
                            @else
                                <option value="0">SOLES</option>
                                <option value="1" selected>DOLARES</option>
                            @endif
                        </select>
                    </div>
                    <div class="col-md-4">
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="cb_ver_total">MOSTRAR TOTAL</label>&nbsp;&nbsp;&nbsp;
                            <input type="checkbox" name="cb_ver_total" id="cb_ver_total" checked value="1">
                            <input type="text" id="txt_ventaTotal" name="txt_ventaTotal" class="form-control totCal"
                                   value="" v-model="totales.totalCot">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>UTILIDAD</label>
                            <input type="text" id="txt_utilidadTotal" name="txt_utilidadTotal"
                                   class="form-control totUti" value="" v-model="totales.totalUtilidad">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>MARGEN</label>
                            <input type="text" id="txt_margenTotal" name="txt_margenTotal"
                                   class="form-control totMargen" value="" v-model="totales.totalMargen">

                        </div>
                    </div>
                </div>

            @endif
        @endif

    </div>

    <div class="row">
        <div class="btn-design">
            {{--        <button class="btn btn-warning btn_pre btn-cot" type="submit" name="btn_pre"><i class="fa fa-save"></i>--}}
            {{--        </button>--}}
            <button class="btn btn-info btn_pre btn-cot" type="button" v-on:click="saveCosteo(items)"><i
                        class="fa fa-save"></i>
            </button>
            <br>
            {{--<a href="{{ url('pdfCarta', $cotizacion) }}" class="btn btn-default btn-cot" target="_blank" disabled>--}}
            {{----}}
            {{--</a>--}}
            {{--<br>--}}
            {{--<button type="submit" name="btn_vistaPrevia">--}}
            {{--</button>--}}
            <a href="{{ url('pdfCoti', [$cotizacion, 0]) }}" class="btn btn-default btn-cot" target="_blank">
                PDC
            </a>
            <br>
            <a href="{{ url('pdfCoti', [$cotizacion, 1]) }}" class="btn btn-default btn-cot" target="_blank">
                PRO
            </a>
            <br>
            <a href="{{ url('pdfCoti', [$cotizacion, 2]) }}" class="btn btn-default btn-cot" target="_blank">
                ANI
            </a>
            <br>
            @if(isset($coti_continue))
                <a href="{{ url('cotizacion',['codiCoti'=>$coti_continue->codiCoti]) }}"
                   class="btn btn-default btn-cot"><i class="fa fa-calculator"></i></a><br>
            @else
                <a href="{{ url('cotizacion',$cotizacion) }}"
                   class="btn btn-default btn-cot" disabled><i class="fa fa-calculator"></i></a><br>
            @endif
            <button class="btn btn-success btn-cot" type="submit" name="btn_coti" alt="Guardar">
                <i class="fa fa-check-square-o"></i>
            </button>
        </div>
    </div>
</main>
{!!Form::close()!!}
<br>
<script>
    $(window).scroll(function () {
        if ($(this).scrollTop() > 0) {
            $('.btn-design').slideDown(200);
        } else {
            $('.btn-design').slideUp(200);
        }
    });
</script>
@include('cotizaciones.condicionesComerciales')

<script src="{{ asset('js/vue-costeo/costeo.js') }}"></script>
<script src="{{ asset('js/vue-cotizacion/cotizacion.js') }}"></script>

<script>
    $(document).ready(function () {

        var cc = parseInt($("#txt_total_costeos").val());
        var sumT = 0;
        var sumU = 0;
        var sumM = 0;
        var totalCosto = 0.0;
        var totalCostoDolar = 0.0;
        var totalMargenCosto = 0.0;
        var cambio = $("#txt_dolar").val();
        var igv = $("#txt_igv").val();

        $('.calCot').each(function () {
            var num1 = $(this).val();
            sumT += parseFloat(num1);
        });
        $('.calUti').each(function () {
            var num2 = $(this).val();
            sumU += parseFloat(num2);
        });
        $('.calMargen').each(function () {
            var num3 = $(this).val();
            sumM += parseFloat(num3) / cc;
        });

        $('.totalCostos').each(function () {
            var num4 = $(this).val();
            totalCosto += parseFloat(num4);
        });

        $('.costoTotalDolares').each(function () {
            var num5 = $(this).val();
            totalCostoDolar += parseFloat(num5);
        });

        $('.mCosto').each(function () {
            var num6 = $(this).val();
            totalMargenCosto += parseFloat(num6) / cc;
        });

        $('.cost_mod').keyup(function () {
            for (var i = 1; i <= cc; i++) {
                if ($(this).attr('name') === 'txt_cantidad' + i || $(this).attr('name') === 'txt_cus_dolar_sin' + i || $(this).attr('name') === 'txt_margen_cu_soles' + i) {
                    var txt_cantidad = "#txt_cantidad" + i;
                    var txt_cus_dolar_sin = "#txt_cus_dolar_sin" + i;
                    var txt_cus_dolar = "#txt_cus_dolar" + i;
                    var txt_total_dolar = "#txt_total_dolar" + i;
                    var txt_cus_soles = "#txt_cus_soles" + i;
                    var txt_total_soles = "#txt_total_soles" + i;
                    var txt_margen_cu_soles = '#txt_margen_cu_soles' + i;
                    var txt_pu_soles = '#txt_pu_soles' + i;
                    var txt_pu_total_soles = '#txt_pu_total_soles' + i;
                    var txt_utilidad_u = '#txt_utilidad_u' + i;
                    var txt_margen_u = '#txt_margen_u' + i;

                    var cantidad = $(txt_cantidad).val();
                    var precioSinIgv = $(txt_cus_dolar_sin).val();

                    var totalDolaresCon = precioSinIgv * (parseFloat(igv) + 1);
                    var totalDolares = totalDolaresCon * cantidad;

                    var totalSolesInc = precioSinIgv * cambio * (parseFloat(igv) + 1);
                    var totalSoles = totalSolesInc * cantidad;

                    //montos en dolares
                    $(txt_cus_dolar).val(parseFloat(totalDolaresCon).toFixed(2));
                    $(txt_total_dolar).val(parseFloat(totalDolares).toFixed(2));

                    //montos en soles
                    $(txt_cus_soles).val(parseFloat(totalSolesInc).toFixed(2));
                    $(txt_total_soles).val(parseFloat(totalSoles).toFixed(2));

                    var margenCuSoles = $(txt_margen_cu_soles).val();//1.35
                    var pus = (margenCuSoles * totalSoles) / cantidad;

                    $(txt_pu_soles).val(parseFloat(pus).toFixed(2));

                    var ventaTotal = pus * cantidad;
                    var uti = ventaTotal - totalSoles;
                    var margen = (uti * 100) / ventaTotal;

                    $(txt_pu_total_soles).val(parseFloat(ventaTotal).toFixed(2));

                    $(txt_utilidad_u).val(parseFloat(uti).toFixed(2));

                    $(txt_margen_u).val(parseFloat(margen).toFixed(2));
                    calcSumas();
                }
                if ($(this).attr('name') === 'txt_pu_soles' + i) {

                    var txt_cantidad = "#txt_cantidad" + i;
                    var txt_cus_dolar_sin = "#txt_cus_dolar_sin" + i;
                    var txt_margen_cu_soles = '#txt_margen_cu_soles' + i;
                    var txt_cus_dolar = "#txt_cus_dolar" + i;
                    var txt_total_dolar = "#txt_total_dolar" + i;
                    var txt_cus_soles = "#txt_cus_soles" + i;
                    var txt_total_soles = "#txt_total_soles" + i;
                    var txt_pu_soles = '#txt_pu_soles' + i;
                    var txt_pu_total_soles = '#txt_pu_total_soles' + i;
                    var txt_utilidad_u = '#txt_utilidad_u' + i;
                    var txt_margen_u = '#txt_margen_u' + i;

                    var cantidad = parseFloat($(txt_cantidad).val());
                    var totalPuSoles = $(txt_pu_soles).val();
                    $(txt_pu_total_soles).val((totalPuSoles * cantidad).toFixed(2));
                    utilidad = parseFloat($(txt_pu_total_soles).val()) - parseFloat($(txt_total_soles).val());
                    margen = (utilidad * 100) / parseFloat($(txt_pu_total_soles).val());
                    $(txt_utilidad_u).val(utilidad.toFixed(2));
                    $(txt_margen_u).val(margen.toFixed(2));

                    calcSumas();
                }
            }
        });

        //eliminar costeoItem
        $(document).on('click', '.del-delItem', function () {
            var id = $(this).attr('id');
            var codiCosteo = $('input[name=_costeo]').val();
            datos = {
                '_token': $('input[name=_token]').val(),
                codiCosteoItem: id,
                codiCosteo: codiCosteo
            };
            $.ajax({
                type: 'POST',
                url: "{{ URL::to('delCosteoItem') }}",
                data: datos,
                success: function (response) {
                    console.log(response);

                    if (response == 'OK') {
                        $('.panel-costeo' + id).remove();
//                        refreshCalculos();
//                        calcSumas();
                        location.reload();
                    } else {
                        console.log("error");
                    }
                }
            });
        });


        function calcSumas() {
            var c = parseInt($("#txt_total_costeos").val());
            var vt = 0.0;
            var ut = 0.0;
            var sub_mt = 0.0;
            for (var i = 1; i < c + 1; i++) {
                vt += parseFloat($('#txt_pu_total_soles' + i).val());
                ut += parseFloat($('#txt_utilidad_u' + i).val());
                sub_mt += parseFloat($('#txt_margen_u' + i).val());
            }
            var mt = sub_mt / c;

            $('#txt_ventaTotal').val(vt.toFixed(2));
            $('#txt_utilidadTotal').val(ut.toFixed(2));
            $('#txt_margenTotal').val(mt.toFixed(2));
        }

        //sumas totales
        $('.totalCosto').val(totalCosto.toFixed(2));
        $('.totalCostoDolar').val(totalCostoDolar.toFixed(2));
        $('.margenCosto').val(totalMargenCosto.toFixed(2));
        $('.totCal').val(sumT.toFixed(2));
        $('.totUti').val(sumU.toFixed(2));
        $('.totMargen').val(sumM.toFixed(2));


        $(function () {
            //campo autocompletable PRODUCTO
            $("#txtProducto").autocomplete({
                source: function (request, response) {
                    $.ajax({
                        url: "{{ URL::to('getProductoCoti') }}",
                        dataType: "json",
                        data: {
                            name: request.term
                        },
                        success: function (data) {
                            response($.map(data, function (item) {
                                return {
//								id: item.codiCoti,
                                    value: item.itemCosteo,
                                }
                            }));
                        }
                    });
                },
                minLength: 3,
//            select: function( event, ui ) {
//                $(this).val(ui.item.value);
//                $('#txt_cliente').val(ui.item.id);
//            }
            });
        });


    });

</script>
