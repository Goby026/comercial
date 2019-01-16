// este componente se muestra en la cotizacion directamente
// usar --partesPc/index.blade.php-- para gestión de partes
// Components
Vue.component('parte-pc', {
    created: function () {
        this.getTCosteo();
        this.getPartes();
        this.getMarcas();
        this.verificarCosteoParte();
    },
    template: `<div class="panel panel-primary panel-produc" v-if="mostrar">
                    <!-- Modal -->
                    <div class="modal fade" id="addComponent" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title" id="addComponentLabel">AGREGAR COMPONENTE</h3>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="add-partes">
                                        <button type="button" class="btn btn-info btn-xs btn-parte" v-for="parte in partes" v-on:click="addComponent(parte)">
                                        <span v-html="parte.icono"></span> <br>
                                        {{ parte.nombre }}
                                        </button>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button> -->
                                    <!--<button type="button" class="btn btn-primary">Agregar</button>-->
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="panel-body">
                        <form method="POST" v-on:submit.prevent="saveData">
                        <div class="row">
                            <div class="col-md-12">
                                <h4>
                                    COTIZACION DE COMPUTADORA DE ESCRITORIO
                                </h4>
                                <hr>
                            </div>
                            <button type='button' class="btn btn-success btn-sm pull-right" data-toggle="modal" data-target="#addComponent" style="margin-right: 5%">+</button>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                            <div class="table-responsive">
                            <table>
                                <thead>
                                <tr>
                                    <th><i class="fa fa-tag"></i></th>
                                    <th>PARTE</th>
                                    <!--<th>MARCA</th>-->
                                    <th style="width:15%">DESCRIPCION</th>
                                    <th>MARGEN C.U.S/.</th>
                                    <th>Cantidad</th>
                                    <th>C.U.$-SIN</th>
                                    <th>C.U.$</th>
                                    <th>C. TOTAL.$</th>
                                    <th>C.U.S/.</th>
                                    <th>C. TOTAL.S/.</th>
                                    <th>P.U.S/.</th>
                                    <th>TOTAL</th>
                                    <th>UTILIDAD</th>
                                    <th>MARGEN</th>
                                    <th colspan="2">ACCIONES</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="parte in partesCoti">
                                    <td><span v-html="parte.icono"></span></td>
                                    <td>{{ parte.nombre }}</td>
                                    <!--<td>
                                        <select class="input-width">
                                            <option v-for="marca in marcas" v-bind:value="marca.codiMarca">
                                                {{ marca.nombreMarca }}
                                            </option>
                                        </select>
                                    </td>-->
                                    <td><input type="text" class="form-control" v-model="parte.descripcion"></td>
                                    <td><input type="text" class="form-control" v-model="parte.margencus"
                                               v-on:keyup="operar(parte)"></td>
                                    <td><input type="text" class="form-control" v-model="parte.cantidad"
                                               v-on:keyup="operar(parte)"></td>
                                    <td><input type="text" class="form-control" v-model="parte.cudsin"
                                               v-on:keyup="operar(parte)"></td>
                                    <td><input type="text" class="form-control" v-model="parte.cud" readonly></td>
                                    <td><input type="text" class="form-control" v-model="parte.totald" readonly></td>
                                    <td><input type="text" class="form-control" v-model="parte.cus" readonly></td>
                                    <td><input type="text" class="form-control" v-model="parte.totals" readonly></td>
                                    <td><input type="text" class="form-control" v-model="parte.pus" v-on:keyup="cambiar(parte)">
                                    </td>
                                    <td><input type="text" class="form-control" v-model="parte.total" readonly></td>
                                    <td><input type="text" class="form-control" v-model="parte.utilidad" readonly></td>
                                    <td><input type="text" class="form-control" v-model="parte.margenfinal" readonly></td>
                                    <td>&nbsp;&nbsp;<button type="button" class="btn btn-danger btn-xs" v-on:click="delComponent(parte)">-</button></td>
                                    <!--<td><button type="button" class="btn btn-warning btn-xs" v-on:click="updateComponent(parte)">*</button></td>-->
                                </tr>
                                
                                <tr>
                                    <td colspan="11"><label class="pull-right">SUBTOTALES</label></td>
                                    <td><input type="text" class="form-control" v-model="totales.totalPS"></td>
                                    <td><input type="text" class="form-control" v-model="totales.totalUtilidad"></td>
                                    <td><input type="text" class="form-control" v-model="totales.totalMargen"></td>
                                </tr>
                                
                                </tbody>
                                </table>
                            </div>
                        </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group table-responsive">
                                    Detalles
                                    <textarea class="form-control" v-model="totales.detalle" rows="5">
                                    </textarea>
                                </div>
                                <label>CANTIDAD</label>
                                <input type="text" class="form-control" v-model="cantidad" v-on:keyup="calculoTotal">
                                <label>TOTAL</label>
                                <input type="text" class="form-control" v-model="total">
                            </div>
                            <div class="col-md-6">
                                <br><br>
                                <center>
                                    <input type="hidden" v-model="totales.imagen">
                                    <img v-if="url" :src="url" style="width:300px;"/>
                                    <br><br>
                                    <input type="file" @change="onFileSelected">
                                    <!--<button type="button" class="btn btn-info" v-on:click="uploadFile">Subir imagen</button>-->  
                                </center>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-success">GUARDAR</button>                                
                                <button type="button" class="btn btn-danger pull-right" data-toggle="modal" data-target="#eliminarCosteoPC">
                                  <i class="fa fa-trash"></i> ELIMINAR
                                </button>
                            </div>
                        </div>
                        
                        <!-- Modal -->
                        <div class="modal fade" id="eliminarCosteoPC" tabindex="-1" role="dialog" aria-labelledby="eliminarCosteoPCLabel">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="eliminarCosteoPCLabel">Eliminar costeo de pc</h4>
                              </div>
                              <div class="modal-body">
                                ¿Quitar costeo?
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                <button type="button" class="btn btn-primary" v-on:click="delComponent()">Confirmar</button>
                              </div>
                            </div>
                          </div>
                        </div>
                        </form>
                    </div>
                </div>`,
    data: function () {
        return {
            codiCosteo: document.querySelector("input[name=_costeo]").value,
            dolar: document.querySelector("input[name=_dolar]").value,
            igv: document.querySelector("input[name=_igv]").value,
            mostrar: false,
            selectedFile: null,
            partesCoti: [],
            partes: [],
            filtroPartes: [],
            marcas:[],
            url: "",
            file: null,
            totales:{
                totalPS: 0,
                totalUtilidad: 0,
                totalMargen: 0,
                detalle: "",
                imagen: ""
            },
            cantidad:1,
            total:0,
            costeo:''
        }
    },
    methods: {
        getPartes: function () {
            var url = '../getPartes';
            axios.get(url).then(response => {
                this.partes = response.data.data.partes;
            });
        },
        getMarcas(){
            var url = '../getMarcas';
            axios.get(url).then( response => {
                // this.partes = response.data.data.partes;
                this.marcas = response.data.data.marcas;
                // console.log( this.marcas );
            });
        },
        getTCosteo(){
            var url = '../getCosteo/'+this.codiCosteo;
            axios.get(url).then( response => {
                // this.partes = response.data.data.partes;
                this.costeo = response.data.data.tcosteo;
                this.cantidad = response.data.data.tcosteo.cantiPc;
                this.totales.detalle = response.data.data.tcosteo.detalle;
                this.totales.imagen = response.data.data.tcosteo.imagen;
                this.url = '../../img/'+response.data.data.tcosteo.imagen;

            });
        },
        filtrarPartes: function(){
            //verificar si la parte esta registrar en la tabla ItemParte
            //obtener todas las partes
        },
        operar: function (parte) {

            var costoUd = parseFloat(parte.cudsin) * (1 + parseFloat(this.igv));
            var total_D = costoUd * parte.cantidad;
            var cu_S = costoUd * parseFloat(this.dolar);
            var total_S = cu_S * parte.cantidad;
            var pu_S = cu_S * parte.margencus;
            var _total = pu_S * parte.cantidad;
            var _utilidad = _total - total_S;
            var _margen = (_utilidad * 100) / _total;

            parte.cud = costoUd.toFixed(2);
            parte.totald = total_D.toFixed(2);
            parte.cus = cu_S.toFixed(2);
            parte.totals = total_S.toFixed(2);
            parte.pus = pu_S.toFixed(2);
            parte.total = _total.toFixed(2);
            parte.utilidad = _utilidad.toFixed(2);
            parte.margenfinal = _margen.toFixed(2);

            this.operar_pus();

            // this.cambiar(parte);
        },
        calculoTotal: function(){
            this.total = this.totales.totalPS * this.cantidad;
        },
        cambiar: function (parte) {
            var _total = parte.pus * parseFloat(parte.cantidad);
            var _utilidad = _total - parte.totals;
            var _margentotal = (_utilidad * 100) / _total;

            parte.total = _total.toFixed(2);
            parte.utilidad = _utilidad.toFixed(2);
            parte.margenfinal = _margentotal.toFixed(2);

            this.operar_pus();
        },
        operar_pus: function () {
            let _total = 0.0;
            let _totalUtilidad = 0.0;
            let _totalMargen = 0.0;
            this.partesCoti.forEach(function (element) {
                _total += parseFloat(element.total);
                _totalUtilidad += parseFloat(element.utilidad);
                _totalMargen += parseFloat(element.margenfinal);
            });

            this.totales.totalPS = _total.toFixed(2);
            this.totales.totalUtilidad = _totalUtilidad.toFixed(2);
            this.totales.totalMargen = (_totalMargen / this.partes.length).toFixed(2);

            this.total = this.totales.totalPS * this.cantidad;
        },
        verificarCosteoParte: function () {
            var url = '../getItemPartes/' + this.codiCosteo;

            var pCoti = [];

            const fCoti = [];

            axios.get(url).then(response => {
                this.partesCoti = response.data.data.items;
                // this.partesCoti.forEach(function (element) {
                //     pCoti.push(element);
                // });

                // this.partes.forEach(function(e){
                //     pCoti.forEach(function(ele){
                //         if (e.codiParte === ele.codiParte){
                //             console.log('OK');
                //         }
                //     });
                // });

                // this.partes.forEach( (e1)=>pCoti.forEach((e2)=>{
                //     if (e1.codiParte === e2.codiParte){
                //         fCoti.push(e1.nombre);
                //     }
                // }));

                if ( this.partesCoti.length > 0 ) {
                    this.mostrar = true;
                    this.operar_pus();
                } else {
                    this.mostrar = false;
                }
            });
        },
        saveData: function () {
            // actualizar totales de costeo
            this.onUpdate();
            this.uploadFile();
            // actualizar los costeos de pc
            this.partesCoti.forEach((element)=>{
                this.updateComponent(element);
            });
        },
        onFileSelected: function (e) {
            let image = e.target.files[0];
            this.read(image);
            let form = new FormData();
            form.append('image', image);
            form.append('codiCosteo', this.codiCosteo);
            this.file = form;
        },
        uploadFile: function() {
            //subir imagen
            var url = "/uploadFile";
            axios.post( url, this.file ).then( response =>{
                console.log(response.data);
            } ).catch(error =>{
                this.errors = error.response.data;
                console.log(this.errors);
            });
        },
        read: function(image){
            let reader = new FileReader();
            reader.readAsDataURL(image);
            reader.onload = (e) => {
                this.url = e.target.result
            }
        },
        onUpdate: function () {
            var url = "/costeoParte/"+this.codiCosteo;

            //registrar descripcion totales cantidad

            axios.post(url, {
                cantiPc: this.cantidad,
                totalPS: this.totales.totalPS,
                totalUtilidad: this.totales.totalUtilidad,
                totalMargen: this.totales.totalMargen,
                detalle:this.totales.detalle,
                imagen:this.totales.imagen
            }).then(response=>{
                console.log(response);
                this.verificarCosteoParte();
            }).catch(error =>{
                this.errors = error.response.data;
                console.log(this.errors);
            });
        },
        addComponent: function(parte){
            var url = "../saveItemParte";
            axios.post(url, {
                codiCosteo: this.codiCosteo,
                codiParte: parte.codiParte
            }).then( response => {
                console.log( response.data );
                $('#addComponent').modal('hide');
                this.verificarCosteoParte();
                // toastr.success('Nuevo sistema creado');
            }).catch(error =>{
                this.errors = error.response.data;
                console.log(this.errors);
            });
        },
        updateComponent: function(parte){
            var url = "../updateItemParte/"+parte.idItemParte;

            axios.post(url, {
                codiParte: parte.codiParte,
                descripcion: parte.descripcion,
                margencus: parte.margencus,
                cantidad: parte.cantidad,
                cudsin: parte.cudsin,
                cud: parte.cud,
                totald: parte.totald,
                cus: parte.cus,
                totals: parte.totals,
                pus: parte.pus,
                total: parte.total,
                utilidad: parte.utilidad,
                margenfinal: parte.margenfinal
            }).then(response=>{
                console.log(response);
                this.verificarCosteoParte();
            }).catch(error =>{
                this.errors = error.response.data;
                console.log(this.errors);
            });
        },
        updateCosteo: function(totales){
            var url = '../costeoParte/' + this.codiCosteo;

            axios.post(url, {
                totalPartes:totales.totalPartes,
                utiPartes:totales.utiPartes,
                margenPartes:totales.margenPartes
            }).then(response=> {
                console.log(response);
            });
        },
        delComponent: function(){
            var url = "../delItemParte/"+this.codiCosteo;
            axios.get(url).then(response=>{
                console.log(response);
                this.verificarCosteoParte();
                $('#eliminarCosteoPC').modal('hide');
            }).catch(error =>{
                this.errors = error.response.data;
                console.log(this.errors);
            });
        }
    }
});

new Vue({
    el: '#partesPC',
    created: function () {
        this.verificarCotizacion();//metodo para verificar si existe costeo de pc en la cotizacion
    },
    data: {
        showButton: false,
        showCosteo: false,
        itemParte: {
            codiParte : null,
            codiCosteo: document.querySelector("input[name=_costeo]").value,
            margencus : 0.0,
            cantidad : 0.0,
            cudsin : 0.0,
            cud : 0.0,
            totald : 0.0,
            cus : 0.0,
            totals : 0.0,
            pus : 0.0,
            total : 0.0,
            utilidad : 0.0,
            margenfinal : 0.0
        },
        errors: []
    },
    methods: {
        regCosteoParte: function () {
            var url = "../saveItemsPartes";
            axios.post(url, {
                codiCosteo: this.itemParte.codiCosteo,
            }).then( response => {
                this.showCosteo = true;
                this.verificarCotizacion();
                $('#myModal').modal('hide');
            }).catch(error =>{
                this.errors = error.response.data;
                console.log(this.errors);
            });

            // this.showData = !this.showData;
        },
        verificarCotizacion: function(){
            //metodo para mostrar el boton : COTIZAR PC
            var url = "../getItemPartes/"+this.itemParte.codiCosteo;
            axios.get(url).then( response => {
                if (response.data.data.items.length > 0){
                    this.showButton = false;
                    this.showCosteo = true;
                    console.log("VERIFICANDO");
                    console.log(this.showCosteo);
                }else{
                    this.showButton = true;
                    this.showCosteo = false;
                }
            }).catch(error =>{
                this.errors = error.response.data;
                console.log(this.errors);
            });
        }
    }

});