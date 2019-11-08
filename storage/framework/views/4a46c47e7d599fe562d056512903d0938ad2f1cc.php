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

    .panel-produc {
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        padding: 2px;
    }

    .panel-produc table tr, th, td {
        font-size: 12px;
    }

    .panel-produc table tr td input {
        margin: 0;
        padding: 0;
        font-size: 12px;
    }

    .panel-condiciones {
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }

    .cabeceras td {
        border: 1px solid #8c8c8c;
        text-align: center;
    }

    .descripcion {
        text-align: center;
        background: #f0ad4e;
        border: 1px solid #8c8c8c;
        text-align: center;
        color: lightcyan;
    }

    .costo {
        text-align: center;
        background: #1b7e5a;
        border: 1px solid #8c8c8c;
        text-align: center;
        color: lightcyan;
    }

    .venta {
        text-align: center;
        background: #0d6aad;
        border: 1px solid #8c8c8c;
        text-align: center;
        color: lightcyan;
    }

    .utilidad {
        text-align: center;
        background: #b94a48;
        border: 1px solid #8c8c8c;
        text-align: center;
        color: lightcyan;
    }
    .action {
        text-align: center;
        background: white;
        text-align: center;
        color: white;
    }

    .sinMargen tr td {
        /*background: #e08e0b;*/
        padding: 0 !important;
        margin: 0 !important;
    }

    .table {
        margin: 0 !important;
        padding: 0 !important;
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

<?php if(isset($coti_continue)): ?>
    <?php echo Form::model($coti_continue,['method'=>'PATCH','route'=>['cotizaciones.update',$coti_continue],'name'=>'frm_coti','files'=>'true']); ?>

<?php else: ?>
    <?php echo Form::model($cotizacion,['method'=>'PATCH','route'=>['cotizaciones.update',$cotizacion],'name'=>'frm_coti','files'=>'true']); ?>

<?php endif; ?>
<?php echo e(Form::token()); ?>


<?php /*<?php echo $__env->make('cotizaciones.clienteAtencionRef', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>*/ ?>
<br>

<div id="cotizacion">
    <coti-desc coti="<?php echo e($cotizacion); ?>"></coti-desc>
</div>
<br>
<main id="costeo">
    <div class="row">
        <div class="col-md-12">
            <input type="hidden" value="<?php echo e($coti_continue); ?>" name="cotizacion">
            <div class="col-md-2">
                DOLAR: <br>
                <button v-on:click="setDolar()" type="button" class="btn btn-primary btn-block">{{ dolar }}</button>
            </div>
            <div class="col-md-2">
                IGV:
                <button @click="setIgv()" type="button" class="btn btn-primary btn-block">{{ igv }}</button>
            </div>
            <div class="col-md-2">
                Fecha: <input type="date" class="form-control" id="txtFecha" name="txtFecha" value="">
            </div>
            <div class="col-md-4 radios">
                <br>
                <label for="cb_producto" style="cursor: pointer; font-size: 16px;">Producto</label>
                <input type="radio" id="cb_producto" value="0" v-model="tipoCoti" v-on:click="setTipoCotizacion(0)"
                       v-on:blur="updateCotizacion()">
                &nbsp;&nbsp;
                <label for="cb_servicio" style="cursor: pointer; font-size: 16px;">Servicio</label>
                <input type="radio" id="cb_servicio" value="1" v-model="tipoCoti" v-on:click="setTipoCotizacion(1)"
                       v-on:blur="updateCotizacion()">
            </div>
            <div class="col-md-2">
                <span>Tipo cotizacion: {{ tipoCoti }}</span>
            </div>
        </div>
    </div>
    <br>
    <div class="container-fluid animated fadeIn">
        <?php /*        pruebas*/ ?>
        <?php /*        productos*/ ?>
        <div v-for="costeo in costeos">
            <main class="panel-produc">
                <div class="row">
                    <div class="col-md-12">

                        <div v-if="costeo.tipoCosteo === 0">
                            <h3>PRODUCTO</h3>
                        </div>
                        <div v-else class="tbl-responsive">
                            <h3>
                                KIT
                                <button v-on:click="addItemCosteo(costeo.codiCosteo)" type="button"
                                        class="btn btn-success btn-sm pull-right"><i class="fa fa-plus"></i></button>
                            </h3>
                            <input v-on:blur="updateCosteo(costeo)" type="text" class="form-control"
                                   v-model="costeo.title" placeholder="Nombre del KIT">
                            <br>
                            <button type="button" class="btn btn-info btn-sm" v-on:click="setMostrarDetalle()">
                                DETALLES
                            </button>
                            <textarea v-tinymce :id="costeo.codiCosteo" style="width: 100% !important;">
                                {{ costeo.descCosteo }}
                            </textarea>
                            <table class="table sinMargen" style="width: 100%">
                                <tr>
                                    <td colspan="5" class="descripcion">DESCRIPCIÓN</td>
                                    <td v-if="mostrarDetalle" colspan="7" class="costo">COSTO</td>
                                    <td v-else colspan="2" class="costo">COSTO</td>
                                    <td v-if="mostrarDetalle" colspan="6" class="venta">VENTA</td>
                                    <td v-else colspan="4" class="venta">VENTA</td>
                                    <td v-if="mostrarDetalle" colspan="5" class="utilidad">UTILIDAD</td>
                                    <td v-else colspan="3" class="utilidad">UTILIDAD</td>
                                </tr>
                                <tr class="cabeceras">
                                    <td class="descripcion" style="width: 9%">PROVEEDOR</td>
                                    <td class="descripcion" style="width: 4%">COD-PROV</td>
                                    <td class="descripcion" style="width: 4%">COD-INT</td>
                                    <td class="descripcion" style="width: 9%">DESC</td>
                                    <td class="descripcion" style="width: 4%">CANT</td>
                                    <td class="costo" style="width: 4%">CU$-SIN-IGV</td>
                                    <td class="costo" v-show="mostrarDetalle" style="width: 4%">CU$-CON-IGV</td>
                                    <td class="costo" v-show="mostrarDetalle" style="width: 4%">TOTAL$-SIN-IGV</td>
                                    <td class="costo" v-show="mostrarDetalle" style="width: 4%">TOTAL$-CON-IGV</td>
                                    <td class="costo" v-show="mostrarDetalle" style="width: 4%">CUS/.-CON-IGV</td>
                                    <td class="costo" v-show="mostrarDetalle" style="width: 4%">CTS/.-CON-IGV</td>
                                    <td class="costo" style="width: 4%">M-COTI</td>
                                    <td class="venta" v-show="mostrarDetalle" style="width: 4%">PU$-SIN-IGV</td>
                                    <td class="venta" v-show="mostrarDetalle" style="width: 4%">TOTAL$-SIN-IGV</td>
                                    <td class="venta" style="width: 4%">PU$-CON-IGV</td>
                                    <td class="venta" style="width: 4%">TOTAL$-CON-IGV</td>
                                    <td class="venta" style="width: 4%">PUS/.-CON-IGV</td>
                                    <td class="venta" style="width: 4%">PTS/.-CON-IGV</td>
                                    <td class="utilidad" v-show="mostrarDetalle" style="width: 4%">UTI$-SIN-IGV</td>
                                    <td class="utilidad" v-show="mostrarDetalle" style="width: 4%">MARG$-SIN-IGV</td>
                                    <td class="utilidad" style="width: 4%">UTIS/.-CON-IGV</td>
                                    <td class="utilidad" style="width: 4%">MARGS/.-CON-IGV</td>
                                    <td class="utilidad" style="width: 1%">ACT</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div v-for="item in items">
                    <div v-if="costeo.codiCosteo === item.codiCosteo">
                        <div v-if="item.tipoCosteo === 1">
                            <?php /*KIT*/ ?>
                            <div class="tbl-responsive">
                                <table class="table sinMargen">
                                    <tr>
                                        <td style="width: 9%"><?php /*1: proveedor*/ ?>
                                            <select name="" id="" class="form-control">
                                                <option value="" v-for="proveedor in proveedores">
                                                    {{ proveedor.nombreProveedor }}
                                                </option>
                                            </select>
                                        </td>
                                        <td style="width: 4%"><?php /*2: codigo proveedor*/ ?>
                                            <input type="text"
                                                   class="form-control"
                                                   placeholder="COD-PROV">
                                        </td>
                                        <td style="width: 4%"><?php /*3: codigo interno*/ ?>
                                            <input type="text"
                                                   class="form-control"
                                                   placeholder="COD-INT">
                                        </td>
                                        <td style="width: 9%"><?php /*4: descripcion equipo*/ ?>
                                            <input type="text"
                                                   class="form-control"
                                                   placeholder="Desc">
                                        </td>
                                        <td style="width: 4%"><?php /*5: cantidad*/ ?>
                                            <input type="text" class="form-control" v-model="item.cantiCoti"
                                                   v-on:keyup="operar(item, costeo)" v-on:blur="handleBlur(item)">
                                        </td>
                                        <td style="width: 4%"><?php /*6: costo unit $ sin igv*/ ?>
                                            <input type="text" class="form-control" v-model="item.precioProducDolar"
                                                   v-on:keyup="operar(item, costeo)" v-on:blur="handleBlur(item)">
                                        </td>
                                        <td v-if="mostrarDetalle" style="width: 4%"><?php /*7: costo unit $ con igv*/ ?>
                                            <input type="text" readonly id="txt_cus_dolar" class="form-control"
                                                   v-model="item.costoUniIgv">
                                        </td><?php /* OK */ ?>
                                        <td v-if="mostrarDetalle" style="width: 4%"><?php /*8: total $ sin igv*/ ?>
                                            <input type="text" id="txt_cus_dolar" class="form-control"
                                                   placeholder="Total $ sin igv" readonly>
                                        </td>
                                        <td v-if="mostrarDetalle" style="width: 4%"><?php /*9: total $ con igv*/ ?>
                                            <input type="text" class="form-control" v-model="item.costoTotalIgv"
                                                   readonly>
                                        </td>
                                        <td v-if="mostrarDetalle" style="width: 4%"><?php /*10: costo unit S/. con igv*/ ?>
                                            <input type="text" readonly class="form-control"
                                                   v-model="item.costoUniSolesIgv">
                                        </td>
                                        <td v-if="mostrarDetalle" style="width: 4%"><?php /*11: costo total S/. con igv*/ ?>
                                            <input type="text" class="form-control" v-model="item.costoTotalSolesIgv"
                                                   readonly>
                                        </td>
                                        <td style="width: 4%"><?php /*12: margen costo*/ ?>
                                            <input type="text" class="form-control" v-model="item.margenCoti"
                                                   v-on:keyup="operar(item, costeo)" v-on:blur="handleBlur(item)">
                                        </td>
                                        <td v-if="mostrarDetalle" style="width: 4%"><?php /*13: prec unit $ sin igv*/ ?>
                                            <input type="text" class="form-control" placeholder="prec unit $ sin igv"
                                                   readonly>
                                        </td>
                                        <td v-if="mostrarDetalle" style="width: 4%"><?php /*14: prec total $ sin igv*/ ?>
                                            <input type="text" class="form-control" placeholder="prec total $ sin igv"
                                                   readonly>
                                        </td>
                                        <td style="width: 4%"><?php /*15: prec unit $ con igv*/ ?>
                                            <input type="text" class="form-control" placeholder="prec unit $ con igv"
                                                   readonly>
                                        </td>
                                        <td style="width: 4%"><?php /*16: prec total $ con igv*/ ?>
                                            <input type="text" class="form-control" placeholder="prec total $ con igv"
                                                   readonly>
                                        </td>
                                        <td style="width: 4%"><?php /*17: prec unit s/. + igv*/ ?>
                                            <input type="text" class="form-control" v-model="item.precioUniSoles"
                                                   v-on:keyup="operar(item, costeo)" v-on:blur="handleBlur(item)">
                                        </td>
                                        <td style="width: 4%"><?php /*18: prec total s/. + igv*/ ?>
                                            <input type="text" readonly class="form-control" v-model="item.precioTotal">
                                        </td>
                                        <td v-if="mostrarDetalle" style="width: 4%"><?php /*19: utilidad $ sin igv*/ ?>
                                            <input type="text" class="form-control" placeholder="prec total $ con igv"
                                                   readonly>
                                        </td>
                                        <td v-if="mostrarDetalle" style="width: 4%"><?php /*20: margen $ sin igv*/ ?>
                                            <input type="text" class="form-control" placeholder="prec total $ con igv"
                                                   readonly>
                                        </td>
                                        <td style="width: 4%"><?php /*21: utilidad S/. inclu igv*/ ?>
                                            <input type="text" readonly class="form-control" v-model="item.utiCoti">
                                        </td>
                                        <td style="width: 4%"><?php /*22: margen inclu igv*/ ?>
                                            <input type="text" readonly class="form-control"
                                                   v-model="item.margenVentaCoti">
                                        </td>
                                        <td style="width: 1%"><?php /*23: boton eliminar*/ ?>
                                            <button type="button" v-on:click="deleteItem(item.idCosteoItem)"
                                                    class="btn btn-danger btn-xs"><i class="fa fa-minus"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div v-else>
                            <input type="text" class="form-control" v-model="item.itemCosteo" placeholder="Producto">
                            <br>
                            <textarea v-tinymce :id="item.idCosteoItem" style="width: 100% !important;"
                                      placeholder="Descrición">
                                {{ item.descCosteoItem }}
                            </textarea>
                            <div class="table-responsive">
                                <table class="table sinMargen">
                                    <tr>
                                        <td v-if="mostrarDetalle" colspan="5" class="descripcion">DESCRIPCIÓN</td>
                                        <td v-else colspan="4" class="descripcion">DESCRIPCIÓN</td>
                                        <td v-if="mostrarDetalle" colspan="7" class="costo">COSTO</td>
                                        <td v-else colspan="2" class="costo">COSTO</td>
                                        <td v-if="mostrarDetalle" colspan="6" class="venta">VENTA</td>
                                        <td v-else colspan="4" class="venta">VENTA</td>
                                        <td v-if="mostrarDetalle" colspan="4" class="utilidad">UTILIDAD</td>
                                        <td v-else colspan="2" class="utilidad">UTILIDAD</td>
                                    </tr>
                                    <tr class="cabeceras">
                                        <?php /*                                        <td class="descripcion" style="width: 10%">PROV</td>*/ ?>
                                        <?php /*                                        <td class="descripcion" style="width: 4%">COD-PROV</td>*/ ?>
                                        <?php /*                                        <td class="descripcion" style="width: 4%">COD-INT</td>*/ ?>
                                        <?php /*                                        <td class="descripcion" style="width: 10%">DESC</td>*/ ?>
                                        <?php /*                                        <td class="descripcion" style="width: 4%">CANT</td>*/ ?>
                                        <?php /*                                        <td class="costo" style="width: 4%">CU$-SIN-IGV</td>*/ ?>
                                        <?php /*                                        <td class="costo" style="width: 4%">CU$-CON-IGV</td>*/ ?>
                                        <?php /*                                        <td class="costo" style="width: 4%">TOTAL$-SIN-IGV</td>*/ ?>
                                        <?php /*                                        <td class="costo" style="width: 4%">TOTAL$-CON-IGV</td>*/ ?>
                                        <?php /*                                        <td class="costo" style="width: 4%">CUS/.-CON-IGV</td>*/ ?>
                                        <?php /*                                        <td class="costo" style="width: 4%">CTS/.-CON-IGV</td>*/ ?>
                                        <?php /*                                        <td class="costo" style="width: 4%">M-COTI</td>*/ ?>
                                        <?php /*                                        <td class="venta" style="width: 4%">PU$-SIN-IGV</td>*/ ?>
                                        <?php /*                                        <td class="venta" style="width: 4%">TOTAL$-SIN-IGV</td>*/ ?>
                                        <?php /*                                        <td class="venta" style="width: 4%">PU$-CON-IGV</td>*/ ?>
                                        <?php /*                                        <td class="venta" style="width: 4%">TOTAL$-CON-IGV</td>*/ ?>
                                        <?php /*                                        <td class="venta" style="width: 4%">PUS/.-CON-IGV</td>*/ ?>
                                        <?php /*                                        <td class="venta" style="width: 4%">PTS/.-CON-IGV</td>*/ ?>
                                        <?php /*                                        <td class="utilidad" style="width: 4%">UTI$-SIN-IGV</td>*/ ?>
                                        <?php /*                                        <td class="utilidad" style="width: 4%">MARG$-SIN-IGV</td>*/ ?>
                                        <?php /*                                        <td class="utilidad" style="width: 4%">UTIS/.-CON-IGV</td>*/ ?>
                                        <?php /*                                        <td class="utilidad" style="width: 4%">MARGS/.-CON-IGV</td>                                        */ ?>


                                        <td class="descripcion">PROVEEDOR</td>
                                        <td class="descripcion">COD-PROV</td>
                                        <td class="descripcion">COD-INT</td>
                                        <td class="descripcion" v-show="mostrarDetalle">DESC</td>
                                        <td class="descripcion">CANT</td>
                                        <td class="costo">CU$-SIN-IGV</td>
                                        <td class="costo" v-show="mostrarDetalle">CU$-CON-IGV</td>
                                        <td class="costo" v-show="mostrarDetalle">TOTAL$-SIN-IGV</td>
                                        <td class="costo" v-show="mostrarDetalle">TOTAL$-CON-IGV</td>
                                        <td class="costo" v-show="mostrarDetalle">CUS/.-CON-IGV</td>
                                        <td class="costo" v-show="mostrarDetalle">CTS/.-CON-IGV</td>
                                        <td class="costo">M-COTI</td>
                                        <td class="venta" v-show="mostrarDetalle">PU$-SIN-IGV</td>
                                        <td class="venta" v-show="mostrarDetalle">TOTAL$-SIN-IGV</td>
                                        <td class="venta">PU$-CON-IGV</td>
                                        <td class="venta">TOTAL$-CON-IGV</td>
                                        <td class="venta">PUS/.-CON-IGV</td>
                                        <td class="venta">PTS/.-CON-IGV</td>
                                        <td class="utilidad" v-show="mostrarDetalle">UTI$-SIN-IGV</td>
                                        <td class="utilidad" v-show="mostrarDetalle">MARG$-SIN-IGV</td>
                                        <td class="utilidad">UTIS/.-CON-IGV</td>
                                        <td class="utilidad">MARGS/.-CON-IGV</td>


                                    </tr>
                                    <tr v-for="item in items" v-if="costeo.codiCosteo == item.codiCosteo">
                                        <td><?php /*1: proveedor*/ ?>
                                            <select name="" id="" class="form-control" style="width: 100%">
                                                <option value="" v-for="proveedor in proveedores">
                                                    {{ proveedor.nombreProveedor }}
                                                </option>
                                            </select>
                                        </td>
                                        <td><?php /*2: codigo proveedor*/ ?>
                                            <input type="text"
                                                   class="form-control"
                                                   placeholder="COD-PROV">
                                        </td>
                                        <td><?php /*3: codigo interno*/ ?>
                                            <input type="text"
                                                   class="form-control"
                                                   placeholder="COD-INT">
                                        </td>
                                        <td v-show="mostrarDetalle"><?php /*4: descripcion equipo*/ ?>
                                            <input type="text"
                                                   class="form-control"
                                                   placeholder="Desc">
                                        </td>
                                        <td><?php /*5: cantidad*/ ?>
                                            <input type="text" class="form-control" v-model="item.cantiCoti"
                                                   v-on:keyup="operar(item, costeo)" v-on:blur="handleBlur(item)">
                                        </td>
                                        <td><?php /*6: costo unit $ sin igv*/ ?>
                                            <input type="text" class="form-control" v-model="item.precioProducDolar"
                                                   v-on:keyup="operar(item, costeo)" v-on:blur="handleBlur(item)">
                                        </td>
                                        <td v-show="mostrarDetalle"><?php /*7: costo unit $ con igv*/ ?>
                                            <input type="text" readonly id="txt_cus_dolar" class="form-control"
                                                   v-model="item.costoUniIgv">
                                        </td><?php /* OK */ ?>
                                        <td v-show="mostrarDetalle"><?php /*8: total $ sin igv*/ ?>
                                            <input type="text" id="txt_cus_dolar" class="form-control"
                                                   placeholder="Total $ sin igv" readonly>
                                        </td>
                                        <td v-show="mostrarDetalle"><?php /*9: total $ con igv*/ ?>
                                            <input type="text" class="form-control" v-model="item.costoTotalIgv"
                                                   readonly>
                                        </td>
                                        <td v-show="mostrarDetalle"><?php /*10: costo unit S/. con igv*/ ?>
                                            <input type="text" readonly class="form-control"
                                                   v-model="item.costoUniSolesIgv">
                                        </td>
                                        <td v-show="mostrarDetalle"><?php /*11: costo total S/. con igv*/ ?>
                                            <input type="text" class="form-control" v-model="item.costoTotalSolesIgv"
                                                   readonly>
                                        </td>
                                        <td><?php /*12: margen costo*/ ?>
                                            <input type="text" class="form-control" v-model="item.margenCoti"
                                                   v-on:keyup="operar(item, costeo)" v-on:blur="handleBlur(item)">
                                        </td>
                                        <td v-show="mostrarDetalle"><?php /*13: prec unit $ sin igv*/ ?>
                                            <input type="text" class="form-control" placeholder="prec unit $ sin igv"
                                                   readonly>
                                        </td>
                                        <td v-show="mostrarDetalle"><?php /*14: prec total $ sin igv*/ ?>
                                            <input type="text" class="form-control" placeholder="prec total $ sin igv"
                                                   readonly>
                                        </td>
                                        <td><?php /*15: prec unit $ con igv*/ ?>
                                            <input type="text" class="form-control" placeholder="prec unit $ con igv"
                                                   readonly>
                                        </td>
                                        <td><?php /*16: prec total $ con igv*/ ?>
                                            <input type="text" class="form-control" placeholder="prec total $ con igv"
                                                   readonly>
                                        </td>
                                        <td><?php /*17: prec unit s/. + igv*/ ?>
                                            <input type="text" class="form-control" v-model="item.precioUniSoles"
                                                   v-on:keyup="operar(item, costeo)" v-on:blur="handleBlur(item)">
                                        </td>
                                        <td><?php /*18: prec total s/. + igv*/ ?>
                                            <input type="text" readonly class="form-control" v-model="item.precioTotal">
                                        </td>
                                        <td v-show="mostrarDetalle"><?php /*19: utilidad $ sin igv*/ ?>
                                            <input type="text" class="form-control" placeholder="prec total $ con igv"
                                                   readonly>
                                        </td>
                                        <td v-show="mostrarDetalle"><?php /*20: margen $ sin igv*/ ?>
                                            <input type="text" class="form-control" placeholder="prec total $ con igv"
                                                   readonly>
                                        </td>
                                        <td><?php /*21: utilidad S/. inclu igv*/ ?>
                                            <input type="text" readonly class="form-control" v-model="item.utiCoti">
                                        </td>
                                        <td><?php /*22: margen inclu igv*/ ?>
                                            <input type="text" readonly class="form-control"
                                                   v-model="item.margenVentaCoti">
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div v-if="costeo.tipoCosteo !== 0">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th colspan="11">Cantidad</th>
                                <th>TOTAL</th>
                                <th>UTILIDAD</th>
                                <th>MARGEN</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td><input type="number" class="form-control" v-model="costeo.cantidad"></td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td><input type="text" v-model="costeo.totalVentaSoles" class="form-control"></td>
                                <td><input type="text" v-model="costeo.utilidadVentaSoles" class="form-control"
                                           disabled></td>
                                <td><input type="text" v-model="costeo.margenVenta" class="form-control" disabled></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <button v-on:click="delCosteo(costeo.codiCosteo)" type="button"
                                class="btn btn-danger pull-right"><i class="fa fa-trash"></i></button>
                    </div>
                </div>
            </main>
            <hr>
        </div>
        <?php /*        pruebas*/ ?>

        <?php if(isset($coti_continue)): ?>
            <?php if(count($costeosItems)>0): ?>
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
                    <input type="hidden" name="_coti" value="<?php echo e($cotizacion); ?>">


                </div>
                <div class="btn-group" style="margin-bottom: 10px;">
                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-desktop"></i> Agregar <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="btn btn-light" v-on:click="newCosteo(0)">Producto <i
                                        class="fa fa-laptop pull-right"></i></a></li>
                        <li><a class="btn btn-light" v-on:click="newCosteo(1)">Kit <i class="fa fa-list pull-right"></i>
                            </a></li>
                    </ul>
                </div>

                <div class="row">
                    <input type="hidden" name="totalCostoDolar" id="totalCostoDolar" class="totalCostoDolar" value="">
                    <input type="hidden" name="totalCosto" id="totalCosto" class="totalCosto" value="">
                    <input type="hidden" name="margenCosto" id="margenCosto" class="margenCosto" value="">
                    <input type="hidden" name="_costeo" id="_costeo" value="<?php echo e($costeo->codiCosteo); ?>">
                    <div class="col-md-2">
                        <label for="">TIPO DE MONEDA</label>
                        <select id="cmb_currency" name="cmb_currency" class="form-control">
                            <?php if($costeo->currency == 0): ?>
                                <option value="0" selected>SOLES</option>
                                <option value="1">DOLARES</option>
                            <?php else: ?>
                                <option value="0">SOLES</option>
                                <option value="1" selected>DOLARES</option>
                            <?php endif; ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="cb_ver_total">MOSTRAR TOTAL</label>
                            <input type="checkbox" id="cb_ver_total" checked value="1" v-model="mostrarTotal"
                                   v-on:change="setMostrarTotal()">
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

            <?php endif; ?>
        <?php endif; ?>

        <a href="<?php echo e(url('pdfCoti', [$cotizacion, 0])); ?>" class="btn btn-default btn-cot" target="_blank">PDC</a>

    </div>

    <?php /*    <div class="row">*/ ?>
    <?php /*        <div class="btn-design">            */ ?>
    <?php /*            <button class="btn btn-info btn_pre btn-cot" type="button" v-on:click="saveCosteo(items)"><i*/ ?>
    <?php /*                        class="fa fa-save"></i>*/ ?>
    <?php /*            </button>*/ ?>
    <?php /*            <br>*/ ?>
    <?php /*            <a href="<?php echo e(url('pdfCoti', [$cotizacion, 0])); ?>" class="btn btn-default btn-cot" target="_blank">*/ ?>
    <?php /*                PDC*/ ?>
    <?php /*            </a>*/ ?>
    <?php /*            <br>*/ ?>
    <?php /*            <a href="<?php echo e(url('pdfCoti', [$cotizacion, 1])); ?>" class="btn btn-default btn-cot" target="_blank">*/ ?>
    <?php /*                PRO*/ ?>
    <?php /*            </a>*/ ?>
    <?php /*            <br>*/ ?>
    <?php /*            <a href="<?php echo e(url('pdfCoti', [$cotizacion, 2])); ?>" class="btn btn-default btn-cot" target="_blank">*/ ?>
    <?php /*                ANI*/ ?>
    <?php /*            </a>*/ ?>
    <?php /*            <br>*/ ?>
    <?php /*            <?php if(isset($coti_continue)): ?>*/ ?>
    <?php /*                <a href="<?php echo e(url('cotizacion',['codiCoti'=>$coti_continue->codiCoti])); ?>"*/ ?>
    <?php /*                   class="btn btn-default btn-cot"><i class="fa fa-eye"></i></a><br>*/ ?>
    <?php /*            <?php else: ?>*/ ?>
    <?php /*                <a href="<?php echo e(url('cotizacion',$cotizacion)); ?>"*/ ?>
    <?php /*                   class="btn btn-default btn-cot" disabled><i class="fa fa-eye"></i></a><br>*/ ?>
    <?php /*            <?php endif; ?>*/ ?>
    <?php /*            <button class="btn btn-success btn-cot" type="submit" name="btn_coti" alt="Guardar">*/ ?>
    <?php /*                <i class="fa fa-check-square-o"></i>*/ ?>
    <?php /*            </button>*/ ?>
    <?php /*        </div>*/ ?>
    <?php /*    </div>*/ ?>
</main>
<?php echo Form::close(); ?>

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
<script>
    // var editor = new FroalaEditor('#example');
</script>
<?php echo $__env->make('cotizaciones.condicionesComerciales', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<script src="<?php echo e(asset('js/vue-costeo/costeo.js')); ?>"></script>
<script src="<?php echo e(asset('js/vue-cotizacion/cotizacion.js')); ?>"></script>
