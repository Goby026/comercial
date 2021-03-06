<style type="text/css">
    .btn-design{
        display: none;
        color: #000;
        position: fixed;
        bottom:100px;
        right: 0;
    }

    .btn-cot{
        padding: 20px;
        font-size: 20px;
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
{{--<div class="row">--}}
    {{--<div id="costeo">--}}
        {{--<h3>@{{mensaje}}</h3><br>--}}
        {{--<label>Dolar</label> :--}}
        {{--<small>@{{dolar}}</small>--}}
        {{--| <label>Igv</label> :--}}
        {{--<small>@{{igv}}</small>--}}
        {{--| <label>Fecha</label> : <input--}}
                {{--type="date"> | <label>Producto</label> : <input type="radio" value="0"> | <label>Servicio</label> :--}}
        {{--<input type="radio" value="0"> | <label>Cotizacion</label> : <input type="text" name="_coti"--}}
                                                                            {{--value="{{$cotizacion}}"><br>--}}
        {{--<h4 style="margin: 0">Productos</h4>--}}
        {{--<div class="pull-right">Num. costeos <input type="text" size="5"></div>--}}
        {{--<br>--}}
        {{--<div style="border: 0.5px solid #c9302c; padding: 10px;">--}}
            {{--<label>Producto</label> : <input type="text" size="123" v-model="costeoItem.itemCosteo"><br>--}}
            {{--<label>Proveedor</label> :--}}
            {{--<select name="" id="" class="selectpicker" data-live-search="true">--}}
                {{--<option value="">INGRAM</option>--}}
                {{--<option value="">DELTRON</option>--}}
                {{--<option value="">MAXIMA</option>--}}
            {{--</select>--}}
            {{--<label>Cod. Interno</label> : <input type="text" size="30" v-model="costeoItem.codInterno">--}}
            {{--<label>Cod. Proveedor</label> : <input type="text" size="30" v-model="costeoItem.codProveedor">--}}
            {{--<br>--}}
            {{--<textarea v-model="costeoItem.descCosteoItem">--}}
            {{--</textarea><br>--}}

            {{--<div style="display: flex;">--}}
                {{--<div style="border: 0.3px solid #990000; padding: 2px;">--}}
                    {{--<input type="text" size="7" v-model="costeoItem.margencus" v-on:keyup="operar(costeoItem)">--}}
                    {{--<input type="text" size="7" v-model="costeoItem.cantidad" v-on:keyup="operar(costeoItem)">--}}
                    {{--<input type="text" size="7" v-model="costeoItem.cudsin" v-on:keyup="operar(costeoItem)">--}}
                    {{--<input type="text" size="7" v-model="costeoItem.cud">--}}
                    {{--<input type="text" size="7" v-model="costeoItem.totald">--}}
                    {{--<input type="text" size="7" v-model="costeoItem.cus">--}}
                    {{--<input type="text" size="7" v-model="costeoItem.totals">--}}
                    {{--<input type="text" size="7" v-model="costeoItem.pus" v-on:keyup="cambiar(costeoItem)">--}}
                {{--</div>--}}

                {{--<div style="border: 0.3px solid #1e6abc; padding: 2px; margin-left: 10px;">--}}
                    {{--<input type="text" size="7" v-model="costeoItem.total">--}}
                    {{--<input type="text" size="7" v-model="costeoItem.utilidad">--}}
                    {{--<input type="text" size="7" v-model="costeoItem.margenfinal">--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div>--}}
            {{--<h4>Tipo de moneda</h4>--}}
            {{--<select name="" id="">--}}
                {{--<option value="">Soles</option>--}}
                {{--<option value="">Dolares</option>--}}
            {{--</select>--}}
        {{--</div>--}}
        {{--<div>--}}
            {{--<h4>Totales</h4>--}}
            {{--<label>Total Cotización</label> : <input type="text" size="30" v-model="totales.totalCot">--}}
            {{--<label>Utilidad</label> : <input type="text" size="30" v-model="totales.totalUtilidad">--}}
            {{--<label>Margen</label> : <input type="text" size="30" v-model="totales.totalMargen">--}}
        {{--</div>--}}
        {{--<button type="button" v-on:click="addCotiCosteo">Agregar costeo</button>--}}
        {{--<button type="button" v-on:click="saveData">Guardar</button>--}}
    {{--</div>--}}
    {{--<div id="cotizacion">--}}
        {{--<p>@{{ coti }}</p>--}}
    {{--</div>--}}
{{--</div>--}}

<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-2">
                Dolar: <input type="text" id="txt_dolar" name="txt_dolar" value="{{ $dolar->dolarVenta }}"
                              class=" form-control" style="text-align: center;">
                <input type="hidden" name="txt_dolar" value="{{ $dolar->codiDolar }}">
            </div>
            <div class="col-md-2">
                IGV: <input type="text" id="txt_igv" name="txt_igv" value="{{ $igv->valorIgv/100 }}"
                            class=" form-control" style="text-align: center;">
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
        <div class="row">
            <div class="col-md-12">
                @include('cotizaciones.costeopc')
            </div>
        </div>
        <br>
    @if(isset($coti_continue))
            @if (count($costeosItems)>0)
                <label>PRODUCTOS</label>
                <span class="pull-right">TOTAL COSTEOS <input type="text" id="txt_total_costeos"
                                                              name="txt_total_costeos"
                                                              value="{{ count($costeosItems) }}" size="5"
                                                              style="text-align: center;"></span>
                @foreach($costeosItems as $costeoItem)
                    <div class="panel panel-primary panel-produc panel-costeo{{ $costeoItem->idCosteoItem }}">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        Producto
                                        @if($costeoItem->itemCosteo == ".")
                                            <input type="text" name="txt_new_product{{ $costeoItem->numPack }}"
                                                   class="form-control txtProducto" value="">
                                        @else
                                            <input type="text" name="txt_new_product{{ $costeoItem->numPack }}"
                                                   class="form-control txtProducto" value="{{ $costeoItem->itemCosteo }}">
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        Proveedor
                                        <div class="input-group">
                                            <select id="txt_proveedor{{ $costeoItem->numPack }}"
                                                    name="txt_proveedor{{ $costeoItem->numPack }}"
                                                    class="form-control selectpicker" data-live-search="true">
                                                @foreach($proveedores as $proveedor)
                                                    @if($proveedor->codiProveedor == $costeoItem->codiProveedor)
                                                        <option value="{{$proveedor->codiProveedor}}"
                                                                selected>{{ $proveedor->nombreProveedor }}</option>
                                                    @else
                                                        <option value="{{$proveedor->codiProveedor}}">{{ $proveedor->nombreProveedor }}</option>
                                                    @endif
                                                @endforeach
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
                                        <input type="text" name="txt_cod_interno{{ $costeoItem->numPack }}"
                                               class="form-control" value="{{ $costeoItem->codInterno }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        Cod. Proveedor
                                        <input type="text" name="txt_cod_proveedor{{ $costeoItem->numPack }}"
                                               class="form-control" value="{{ $costeoItem->codProveedor }}">
                                    </div>
                                </div>
                                <div class="col-md-8 col-md-offset-2">
                                    <div class="form-group">
                                        <label for="">Descripción</label>
                                            <textarea id="txt_descripcion"
                                                      class="form-control txt_descripcion"
                                                      name="txt_descripcion{{ $costeoItem->numPack }}">
                                                    {{ $costeoItem->descCosteoItem }}
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
                                            <table>
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
                                                <tr class="fila{{$costeoItem->numPack}}">
                                                    <td>
                                                        <input type="text"
                                                               id="txt_margen_cu_soles{{ $costeoItem->numPack }}"
                                                               class="form-control cost_mod mCosto"
                                                               name="txt_margen_cu_soles{{ $costeoItem->numPack }}"
                                                               style="width: 100%; text-align: center;"
                                                               value="{{ $costeoItem->margenCoti }}"></td>
                                                    <td>
                                                        <input type="text" id="txt_cantidad{{ $costeoItem->numPack }}"
                                                               class="form-control cost_mod"
                                                               name="txt_cantidad{{ $costeoItem->numPack }}"
                                                               style="width: 100%; text-align: center;"
                                                               value="{{ $costeoItem->cantiCoti }}"></td>
                                                    <td>
                                                        <input type="text"
                                                               id="txt_cus_dolar_sin{{ $costeoItem->numPack }}"
                                                               class="form-control cost_mod"
                                                               name="txt_cus_dolar_sin{{ $costeoItem->numPack }}"
                                                               style="width: 100%; text-align: center;"
                                                               value="{{ $costeoItem->precioProducDolar }}"></td>
                                                    <td>
                                                        <input type="text" readonly
                                                               id="txt_cus_dolar{{ $costeoItem->numPack }}"
                                                               class="form-control"
                                                               name="txt_cus_dolar{{ $costeoItem->numPack }}"
                                                               style="width: 100%; text-align: center;"
                                                               value="{{ $costeoItem->costoUniIgv }}"></td>
                                                    <td>
                                                        <input type="text" readonly
                                                               id="txt_total_dolar{{ $costeoItem->numPack }}"
                                                               class="form-control costoTotalDolares"
                                                               name="txt_total_dolar{{ $costeoItem->numPack }}"
                                                               style="width: 100%; text-align: center;"
                                                               value="{{ $costeoItem->costoTotalIgv }}"></td>
                                                    <td>
                                                        <input type="text" readonly
                                                               id="txt_cus_soles{{ $costeoItem->numPack }}"
                                                               class="form-control"
                                                               name="txt_cus_soles{{ $costeoItem->numPack }}"
                                                               style="width: 100%; text-align: center;"
                                                               value="{{ $costeoItem->costoUniSolesIgv }}"></td>
                                                    <td>
                                                        <input type="text" readonly
                                                               id="txt_total_soles{{ $costeoItem->numPack }}"
                                                               class="form-control totalCostos"
                                                               name="txt_total_soles{{ $costeoItem->numPack }}"
                                                               style="width: 100%; text-align: center;"
                                                               value="{{ $costeoItem->costoTotalSolesIgv }}"></td>
                                                    <td>
                                                        <input type="text" id="txt_pu_soles{{ $costeoItem->numPack }}"
                                                               class="form-control cost_mod"
                                                               name="txt_pu_soles{{ $costeoItem->numPack }}"
                                                               style="width: 100%; text-align: center;"
                                                               value="{{ $costeoItem->precioUniSoles }}">
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
                                                <table>
                                                    <thead>
                                                    <th>TOTAL</th>
                                                    <th>UTILIDAD</th>
                                                    <th>MARGEN</th>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        <td>
                                                            <input type="text" readonly
                                                                   id="txt_pu_total_soles{{ $costeoItem->numPack }}"
                                                                   class="form-control calCot"
                                                                   name="txt_pu_total_soles{{ $costeoItem->numPack }}"
                                                                   style="width: 100%; text-align: center;"
                                                                   value="{{ $costeoItem->precioTotal }}">
                                                        </td>
                                                        <td>
                                                            <input type="text" readonly
                                                                   id="txt_utilidad_u{{ $costeoItem->numPack }}"
                                                                   class="form-control calUti"
                                                                   name="txt_utilidad_u{{ $costeoItem->numPack }}"
                                                                   style="width: 100%; text-align: center;"
                                                                   value="{{ $costeoItem->utiCoti }}">
                                                        </td>
                                                        <td>
                                                            <input type="text" readonly
                                                                   id="txt_margen_u{{ $costeoItem->numPack }}"
                                                                   class="form-control calMargen"
                                                                   name="txt_margen_u{{ $costeoItem->numPack }}"
                                                                   style="width: 100%; text-align: center;"
                                                                   value="{{ $costeoItem->margenVentaCoti  }}">
                                                        </td>
                                                    </tr>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <a id="modal-{{ $costeoItem->idCosteoItem }}"
                               href="#modal-container-{{ $costeoItem->idCosteoItem }}" role="button"
                               class="btn btn-danger pull-right" data-toggle="modal"><i class="fa fa-trash"></i>
                                Eliminar Costeo</a>
                        </div>

                        <!-- Modal para eliminar item -->
                        <div class="modal fade" id="modal-container-{{ $costeoItem->idCosteoItem }}" role="dialog"
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
                                                id="{{ $costeoItem->idCosteoItem }}" data-dismiss="modal">
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
                @endforeach
                <div class="row">
                    {{--<button class="btn btn-primary pull-right add-modal-newItem"--}}
                            {{--type="button" style="width: auto; margin-right: 15px; margin-top: -10px;">--}}
                        {{--<i class="fa fa-desktop"></i>--}}
                        {{----}}
                    {{--</button>--}}
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary pull-right btn-lg" data-toggle="modal" data-target="#newItem" style="width: auto; margin-right: 15px; margin-top: -10px;">
                        <i class="fa fa-desktop"></i>
                        Agregar Producto
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="newItem" tabindex="-1" role="dialog" aria-labelledby="newItemLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h2 class="modal-title" id="newItemLabel">Agregar costeo</h2>
                                </div>
                                <div class="modal-body">
                                    ¿DESEA AGREGAR OTRO ITEM?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                    <button type="button" class="btn btn-primary add-newItem">Continuar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @else

            <label>PRODUCTOS</label>
            <span class="pull-right">TOTAL COSTEOS <input type="text" id="txt_total_costeos" name="txt_total_costeos"
                                                          value="1" size="5" style="text-align: center;"></span>
            <div class="panel panel-primary panel-produc">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                Producto
                                <input type="text" name="txt_new_product1" class="form-control txtProducto"
                                       value="{{ old('txt_new_product1') }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                Proveedor
                                <select id="txt_proveedor1" name="txt_proveedor1" class="form-control selectpicker"
                                        data-live-search="true">
                                    @foreach($proveedores as $proveedor)
                                        <option value="{{$proveedor->codiProveedor}}">{{ $proveedor->nombreProveedor }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                Cod. Interno
                                <input type="text" name="txt_cod_interno1" class="form-control"
                                       value="{{ old('txt_cod_interno1') }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                Cod. Proveedor
                                <input type="text" name="txt_cod_proveedor1" class="form-control"
                                       value="{{ old('txt_cod_proveedor1') }}">
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                Descripción
                                <textarea id="txt_descripcion1" class="form-control txt_descripcion"
                                          name="txt_descripcion1"
                                          placeholder="Detalles de producto">
                                </textarea>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <center><label for="">Imagen</label></center>
                            <div class="form-group">
											<textarea name="txt_imagen1" id="txt_imagen"
                                                      class="form-control txt_imagen">

											</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-8">
                            <div class="panel panel-danger">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Costeo Perú Data</h3>
                                </div>
                                <div class="panel-body">
                                    <table>
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
                                        <td><input type="text" id="txt_margen_cu_soles1" name="txt_margen_cu_soles1"
                                                   class="form-control cost_mod"
                                                   value="{{ old('txt_margen_cu_soles1') }}">
                                        </td>
                                        <td><input type="text" id="txt_cantidad1" name="txt_cantidad1"
                                                   class="form-control cost_mod" value="{{ old('txt_cantidad1') }}">
                                        </td>
                                        <td><input type="text" id="txt_cus_dolar_sin1" name="txt_cus_dolar_sin1"
                                                   class="form-control cost_mod"
                                                   value="{{ old('txt_cus_dolar_sin1') }}">
                                        </td>
                                        <td><input type="text" readonly id="txt_cus_dolar1" name="txt_cus_dolar1"
                                                   class="form-control" value="{{ old('txt_cus_dolar1') }}"></td>
                                        <td><input type="text" readonly id="txt_total_dolar1" name="txt_total_dolar1"
                                                   class="form-control costoTotalDolares"
                                                   value="{{ old('txt_total_dolar1') }}"></td>
                                        <td><input type="text" readonly id="txt_cus_soles1" name="txt_cus_soles1"
                                                   class="form-control" value="{{ old('txt_cus_soles1') }}"></td>
                                        <td><input type="text" readonly id="txt_total_soles1" name="txt_total_soles1"
                                                   class="form-control" value="{{ old('txt_total_soles1') }}"></td>
                                        <td><input type="text" id="txt_pu_soles1" name="txt_pu_soles1"
                                                   class="form-control cost_mod" value="{{ old('txt_pu_soles1') }}">
                                        </td>
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
                                        <table>
                                            <thead>
                                            <th>TOTAL</th>
                                            <th>UTILIDAD</th>
                                            <th>MARGEN</th>
                                            </thead>
                                            <tbody>
                                            <td><input type="text" readonly id="txt_pu_total_soles1"
                                                       name="txt_pu_total_soles1" class="form-control"
                                                       value="{{ old('txt_pu_total_soles1') }}"></td>
                                            <td><input type="text" readonly id="txt_utilidad_u1" name="txt_utilidad_u1"
                                                       class="form-control" value="{{ old('txt_utilidad_u1') }}">
                                            </td>
                                            <td><input type="text" readonly id="txt_margen_u1" name="txt_margen_u1"
                                                       class="form-control" value="{{ old('txt_margen_u1') }}"></td>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <div id="campos"></div>
    </div>
</div>
<div class="row">
    <input type="hidden" name="totalCostoDolar" id="totalCostoDolar" class="totalCostoDolar" value="">
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
            @if($costeo->mostrarTotal == 1)
                <input type="checkbox" name="cb_ver_total" id="cb_ver_total" checked value="1">
                {{--<input type="text" id="txt_ventaTotal" name="txt_ventaTotal" class="form-control" value="{{ $costeo->totalVentaSoles }}">--}}
                <input type="text" id="txt_ventaTotal" name="txt_ventaTotal" class="form-control totCal" value="">
            @else
                <input type="checkbox" name="cb_ver_total" id="cb_ver_total" value="1">
                <input type="text" id="txt_ventaTotal" name="txt_ventaTotal" class="form-control totCal" value="">
            @endif
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label>UTILIDAD</label>
            @if(isset($coti_continue))
                <input type="text" id="txt_utilidadTotal" name="txt_utilidadTotal" class="form-control totUti" value="">
            @else
                <input type="text" id="txt_utilidadTotal" name="txt_utilidadTotal" class="form-control totUti" value="">
            @endif
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label>MARGEN</label>
            @if(isset($coti_continue))
                <input type="text" id="txt_margenTotal" name="txt_margenTotal" class="form-control totMargen" value="">
            @else
                <input type="text" id="txt_margenTotal" name="txt_margenTotal" class="form-control totMargen" value="">
            @endif
        </div>
    </div>
</div>
<div class="row">
    <div class="btn-design">
        <button class="btn btn-warning btn_pre btn-cot" type="submit" name="btn_pre"><i class="fa fa-save"></i>
        </button>
        <br>
        {{--<a href="{{ url('pdfCarta', $cotizacion) }}" class="btn btn-default btn-cot" target="_blank" disabled>--}}
            {{----}}
        {{--</a>--}}
        {{--<br>--}}
        {{--<button type="submit" name="btn_vistaPrevia">--}}
        {{--</button>--}}
        <a href="{{ url('pdfCoti', $cotizacion) }}" class="btn btn-default btn-cot" target="_blank">
            <i class="fa fa-file-pdf-o"></i>
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

{!!Form::close()!!}
<br>
<script>
    $(window).scroll(function(){
        if ( $(this).scrollTop() > 0 ){
            $('.btn-design').slideDown(200);
        }else{
            $('.btn-design').slideUp(200);
        }
    });
</script>
@include('cotizaciones.condicionesComerciales')

<script>
    var editor_config = {
        selector: 'textarea',
        plugins: 'image media link code imagetools textcolor colorpicker',
        api_key: 'YOUR_API_KEY',
        height: 400,
        width: 1000,
        tinydrive_token_provider: 'URL_TO_YOUR_TOKEN_PROVIDER',
        toolbar: ' forecolor backcolor | sizeselect | bold italic | fontselect |  fontsizeselect | alignleft aligncenter alignright alignjustify'
    };

    tinymce.init(editor_config);

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
        $(document).on('click', '.del-delItem', function() {
            var id = $(this).attr('id');
            var codiCosteo =$('input[name=_costeo]').val();
            datos = {
                '_token':$('input[name=_token]').val(),
                codiCosteoItem : id,
                codiCosteo : codiCosteo
            };
            $.ajax({
                type: 'POST',
                url: "{{ URL::to('delCosteoItem') }}",
                data: datos,
                success: function(response) {
                    console.log(response);

                    if (response == 'OK') {
                        $('.panel-costeo'+id).remove();
//                        refreshCalculos();
//                        calcSumas();
                        location.reload();
                    }else{
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
    });

//    $(window).scroll(function(){
//        if($(document).scrollTop()>=$(document).height()/5)
//            $("#spopup").show("slow");
//        else $("#spopup").hide("slow");
//    });
//
//    function closeSPopup(){
//        $('#spopup').hide('slow');
//    }

    $(function() {
        //campo autocompletable PRODUCTO
        $( ".txtProducto" ).autocomplete({
            source: function( request, response ) {
                $.ajax({
                    url: "{{ URL::to('getProductoCoti') }}",
                    dataType: "json",
                    data: {
                        name: request.term
                    },
                    success: function( data ) {
                        response($.map(data, function(item){
                            return{
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

</script>
<script src="{{ asset('js/vue-costeo/costeo.js') }}"></script>
<script src="{{ asset('js/vue-cotizacion/cotizacion.js') }}"></script>