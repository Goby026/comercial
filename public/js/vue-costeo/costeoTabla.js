Vue.component('tabla', {
    created(){
        this.getCoti();
        this.getCosteos();
        this.getData();
    },
    data: function () {
        return {
            costeos:[],
            items: [],
            proveedores:[],
            dolar: 0.0,
            igv: 0.0,
            cotizacion:{}
        }
    },
    props: {
        coti: String
    },
    methods: {
        getCoti: function(){
            this.cotizacion = JSON.parse(this.coti);

            var url = '/getData/'+this.cotizacion.codiCoti;
            axios.get(url).then( response => {
                // this.costeoItem.itemCosteo = response.data.data.costeoItem.itemCosteo;
                // this.costeoItem.codInterno = response.data.data.costeoItem.codInterno;
                // this.costeoItem.codProveedor = response.data.data.costeoItem.codProveedor;
                // this.costeoItem.descCosteoItem = response.data.data.costeoItem.descCosteoItem;
            });

            this.dolar = this.cotizacion.dolar;
            this.igv = this.cotizacion.igv;
            console.log('COTIZACION: ', this.cotizacion);
        },
        getCosteos: function(){
            var url = '/getCosteos/'+this.cotizacion.codiCoti;
            axios.get(url).then( response => {

                this.costeos = response.data.data.costeos;
                this.items = response.data.data.items;
                // this.dolar = this.cotizacion.dolar;
                // this.igv = this.cotizacion.igv;

                console.log('COSTEOS', this.costeos);

            });
        },
        getData: function() {
            var url = '/getData/'+this.cotizacion.codiCoti;
            axios.get(url).then( response => {
                this.proveedores = response.data.data.proveedores;
                // this.setTotales();
            });
        },
        setDolar: async function(){
            const { value: dolar } = await Swal.fire({
                title: 'Ingrese tipo de cambio',
                input: 'text',
                inputPlaceholder: 'valor actual'
            });

            if (dolar) {
                // Swal.fire('Entered email: ' + email)
                this.dolar = dolar;
                //persistir a bd
                this.items.forEach((element)=>{
                    this.operar(element);
                    // console.log(element);
                });

                this.prods.forEach((element)=>{
                    this.operar(element);
                    // console.log(element);
                });
            }

        },
        setIgv: async function(){

            const { value: igv } = await Swal.fire({
                title: 'Ingrese IGV',
                input: 'text',
                inputPlaceholder: 'valor de igv'
            });

            if (igv) {
                this.igv = igv;
                //persistir a bd
                this.items.forEach((element)=>{
                    this.operar(element);
                    // console.log(element);
                });

                this.prods.forEach((element)=>{
                    this.operar(element);
                    // console.log(element);
                });
            }

        },
        verDetalle: async function(detalle){
            const { value: text } = await Swal.fire({
                input: 'textarea',
                inputValue: detalle,
                html: detalle,
                inputPlaceholder: 'Type your message here...',
                inputAttributes: {
                    'aria-label': 'Type your message here'
                },
                showCancelButton: true
            });

            if (text) {
                Swal.fire(text)
            }
        }
    },
    template:
        `<div class="container-fluid">
            <div class="row">
                <div class="col-md-12 table-responsive">
                    <table class="table" >                    
                        <tbody>
                            <tr>
                                <td>
                                    <div class="panel panel-info">
                                      <div class="panel-heading">
                                        <h3 class="panel-title text-center">Número de cotización</h3>
                                      </div>
                                      <div class="panel-body text-center">
                                        {{ cotizacion.numCoti }}
                                      </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="panel panel-info">
                                      <div class="panel-heading">
                                        <h3 class="panel-title text-center">Cantidad de costeos</h3>
                                      </div>
                                      <div class="panel-body text-center">
                                        1
                                      </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="panel panel-info">
                                      <div class="panel-heading">
                                        <h3 class="panel-title text-center">dolar</h3>
                                      </div>
                                      <div class="panel-body text-center">
                                        <button @click="setDolar(cotizacion.codiCoti)" class="btn btn-light btn-sm btn-block">{{dolar}}</button>
                                      </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="panel panel-info">
                                      <div class="panel-heading">
                                        <h3 class="panel-title text-center">Igv</h3>
                                      </div>
                                      <div class="panel-body text-center">
                                        <button @click="setIgv()" class="btn btn-light btn-sm btn-block">{{igv}}</button>
                                      </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <button @click="prueba()" class="btn btn-success btn-sm pull-right add-modal-newItem" type="button" style="margin-right: 30px;"><i class="fa fa-plus-square"></i>&nbsp;&nbsp; Agregar costeo
                </button>
            </div>
            <br>
            <div class="panel-produc">
                <div v-for="costeo in costeos">
                    <div class="row">
                        <div class="col-md-12">
        
                            <div v-if="costeo.tipoCosteo === 0">
                                <h5>PRODUCTO</h5>
                            </div>
                            <div v-else>
                                <h5>
                                    KIT
                                </h5>
                                <input v-on:blur="updateCosteo(costeo)" type="text" class="form-control" v-model="costeo.title" placeholder="Nombre del KIT">
        <!--                        <textarea v-tinymce :id="costeo.codiCosteo" style="width: 100% !important;">-->
        <!--                            {{ costeo.descCosteo }}-->
        <!--                        </textarea>-->
                                <table style="width: 100%">
                                    <tr>
                                        <td colspan="5" class="descripcion">DESCRIPCIÓN</td>
                                        <td colspan="5" class="costo">COSTO</td>
                                        <td colspan="4" class="venta">VENTA</td>
                                    </tr>
                                    <tr class="cabeceras">
                                        <td class="descripcion" style="width: 10%">PROV</td>
                                        <td class="descripcion" style="width: 10%">COD-PROV</td>
                                        <td class="descripcion" style="width: 5%">COD-INT</td>
                                        <td class="descripcion" style="width: 5%">M-COTI</td>
                                        <td class="descripcion" style="width: 5%">CANT</td>
                                        <td class="costo" style="width: 5%">COS-$</td>
                                        <td class="costo" style="width: 5%">CU$+igv</td>
                                        <td class="costo" style="width: 5%">CT$+igv</td>
                                        <td class="costo" style="width: 5%">CU+igv</td>
                                        <td class="costo" style="width: 5%">CT+igv</td>
                                        <td class="venta" style="width: 5%">PUS</td>
                                        <td class="venta" style="width: 5%">PREC</td>
                                        <td class="venta" style="width: 5%">UTI</td>
                                        <td class="venta" style="width: 5%">MARG</td>
                                    </tr>
                                </table>
                            </div>
        
                        </div>
                    </div>
                    <div v-for="item in items">
                        <div v-if="costeo.codiCosteo === item.codiCosteo">
                            <div v-if="item.tipoCosteo === 1">
                                <table>
                                    <tr>
                                        <td style="width: 10%">
                                            <select name="" id="" class="form-control">
                                                <option value="" v-for="proveedor in proveedores">
                                                    {{ proveedor.nombreProveedor }}
                                                </option>
                                            </select>
                                        </td>
                                        <td style="width: 10%">
                                            <input type="text"
                                                   class="form-control"
                                                   placeholder="COD-PROV">
                                        </td>
                                        <td style="width: 5%">
                                            <input type="text"
                                                   class="form-control"
                                                   placeholder="COD-INT">
                                        </td>
                                        <td style="width: 5%"><input type="text"
                                                   class="form-control"
                                                   v-model="item.margenCoti"
                                                   v-on:keyup="operar(item)"
                                                   v-on:blur="handleBlur(item)"></td>
                                        <td style="width: 5%"><input type="text"
                                                   class="form-control"
                                                   v-model="item.cantiCoti"
                                                   v-on:keyup="operar(item)"
                                                   v-on:blur="handleBlur(item)"></td>
                                        <td style="width: 5%"><input type="text"
                                                   class="form-control"
                                                   v-model="item.precioProducDolar"
                                                   v-on:keyup="operar(item)"
                                                   v-on:blur="handleBlur(item)"></td>
                                        <td style="width: 5%"><input type="text" readonly
                                                   id="txt_cus_dolar"
                                                   class="form-control"
                                                   v-model="item.costoUniIgv"></td>
                                        <td style="width: 5%"><input type="text" readonly
                                                   class="form-control"
                                                   v-model="item.costoTotalIgv"></td>
                                        <td style="width: 5%"><input type="text" readonly
                                                   class="form-control"
                                                   v-model="item.costoUniSolesIgv"></td>
                                        <td style="width: 5%"><input type="text" readonly
                                                   class="form-control"
                                                   v-model="item.costoTotalSolesIgv"></td>
                                        <td style="width: 5%"><input type="text"
                                                   class="form-control"
                                                   v-model="item.precioUniSoles"
                                                   v-on:keyup="operar_pus(item)"
                                                   v-on:blur="handleBlur(item)"></td>
                                        <td style="width: 5%"><input type="text" readonly
                                                   class="form-control"
                                                   v-model="item.precioTotal"></td>
                                        <td style="width: 5%"><input type="text" readonly
                                                   class="form-control"
                                                   v-model="item.utiCoti"></td>
                                        <td style="width: 5%"><input type="text" readonly
                                                   class="form-control"
                                                   v-model="item.margenVentaCoti"></td>
                                    </tr>
                                </table>
                            </div>
                            <div v-else>
                                <input type="text" class="form-control" v-model="item.itemCosteo" placeholder="Producto">
        <!--                        <textarea v-tinymce :id="item.idCosteoItem" style="width: 100% !important;" placeholder="Descrición">-->
        <!--                            {{ item.descCosteoItem }}-->
        <!--                        </textarea>-->
                                <table>
                                    <tr>
                                        <td colspan="5" class="descripcion">DESCRIPCIÓN</td>
                                        <td colspan="5" class="costo">COSTO</td>
                                        <td colspan="4" class="venta">VENTA</td>
                                    </tr>
                                    <tr class="cabeceras">
                                        <td class="descripcion">PROV</td>
                                        <td class="descripcion">COD-PROV</td>
                                        <td class="descripcion">COD-INT</td>
                                        <td class="descripcion">M-COTI</td>
                                        <td class="descripcion">CANT</td>
                                        <td class="costo">COS-$</td>
                                        <td class="costo">CU$+igv</td>
                                        <td class="costo">CT$+igv</td>
                                        <td class="costo">CU+igv</td>
                                        <td class="costo">CT+igv</td>
                                        <td class="venta">PUS</td>
                                        <td class="venta">PREC</td>
                                        <td class="venta">UTI</td>
                                        <td class="venta">MARG</td>
                                    </tr>
                                    <tr v-for="item in items" v-if="costeo.codiCosteo == item.codiCosteo">
                                        <td>
                                            <select name="" id="" class="form-control">
                                                <option value="" v-for="proveedor in proveedores">
                                                    {{ proveedor.nombreProveedor }}
                                                </option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="text"
                                                   class="form-control"
                                                   placeholder="COD-PROV">
                                        </td>
                                        <td>
                                            <input type="text"
                                                   class="form-control"
                                                   placeholder="COD-INT">
                                        </td>
                                        <td><input type="text"
                                                   class="form-control"
                                                   v-model="item.margenCoti"
                                                   v-on:keyup="operar(item)"
                                                   v-on:blur="handleBlur(item)"></td>
                                        <td><input type="text"
                                                   class="form-control"
                                                   v-model="item.cantiCoti"
                                                   v-on:keyup="operar(item)"
                                                   v-on:blur="handleBlur(item)"></td>
                                        <td><input type="text"
                                                   class="form-control"
                                                   v-model="item.precioProducDolar"
                                                   v-on:keyup="operar(item)"
                                                   v-on:blur="handleBlur(item)"></td>
                                        <td><input type="text" readonly
                                                   id="txt_cus_dolar"
                                                   class="form-control"
                                                   v-model="item.costoUniIgv"></td>
                                        <td><input type="text" readonly
                                                   class="form-control"
                                                   v-model="item.costoTotalIgv"></td>
                                        <td><input type="text" readonly
                                                   class="form-control"
                                                   v-model="item.costoUniSolesIgv"></td>
                                        <td><input type="text" readonly
                                                   class="form-control"
                                                   v-model="item.costoTotalSolesIgv"></td>
                                        <td><input type="text"
                                                   class="form-control"
                                                   v-model="item.precioUniSoles"
                                                   v-on:keyup="operar_pus(item)"
                                                   v-on:blur="handleBlur(item)"></td>
                                        <td><input type="text" readonly
                                                   class="form-control"
                                                   v-model="item.precioTotal"></td>
                                        <td><input type="text" readonly
                                                   class="form-control"
                                                   v-model="item.utiCoti"></td>
                                        <td><input type="text" readonly
                                                   class="form-control"
                                                   v-model="item.margenVentaCoti"></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>          
                </div>
            </div>
            
        </div>`
});

new Vue({el: '#components-demo'});
