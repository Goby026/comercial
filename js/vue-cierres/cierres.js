//componentes
Vue.component('cierres', {
    template: `<table class="table table-striped table-bordered table-condensed table-hover">
                    <thead class="head-table">
                        <th><i class="fa fa-file"></i> Cotización</th>
                        <th><i class="fa fa-address-book-o"></i> Cliente</th>
                        <th><i class="fa fa-calendar"></i> Fecha Coti</th>
                        <th><i class="fa fa-print"></i> Documento</th>
                        <th><i class="fa fa-hashtag"></i></th>
                        <th><i class="fa fa-check-square-o"></i> Estado</th>
                        <th><i class="fa fa-money"></i> Total</th>
                        <th><i class="fa fa-percent"></i> Margen</th>
                        <th colspan="2"><i class="fa fa-cog"></i> Acciones</th>
                    </thead>
                    <tbody>
                        <tr v-for="cierre in cierres">
                            <td>{{cierre.numCoti}}</td>
                            <td>{{cierre.nomCli}}</td>
                            <td>{{cierre.fechaCoti}}</td>
                            <td>{{cierre.nombreTipoComproPago}}</td>
                            <td>{{cierre.numeComproPago}}</td>
                            <td>{{cierre.nombreEstaPago}}</td>
                            <td>{{cierre.montoTotalFactuSIGV}}</td>
                            <td>{{cierre.margenFinal}}</td>
                            <td>
                                <a id="{{cierre.numCoti}}" href="#modal-container-{{cierre.numCoti}}" role="button"
                                       class="btn btn-danger btn-xs"
                                       data-toggle="modal"><li class="fa fa-money"></li> Add. Gastos</a>
                                <div class="modal fade" id="modal-container-{{cierre.numCoti}}" role="dialog"
                                         aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header"
                                                     style="background-color: #9f191f; color: #FDFDFD;">
                                                    <h4 class="modal-title" id="myModalLabel">
                                                        <b>GESTION DE GASTOS</b>
                                                        <button type="button" class="close" data-dismiss="modal">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </h4>
                                                    <hr>
                                                    <em>
                                                        <small><u>COTIZACION: {{cierre.numCoti}}</u> -</small>
                                                        FACTURA: <u>{{cierre.numeComproPago}}</u>
                                                    </em>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                            </td>
                            <td v-if="cierre.estado == 1"><button class="btn btn-info btn-xs" v-on:click="getMerca(cierre)">Merca</button></td>
                            <td v-else><a href="#" class="btn btn-warning btn-xs" v-on:click="setGastos(cierre)"><i class="fa fa-cog"></i> Mod. Gastos</a></td>
                        </tr>
                    </tbody>
                </table>`,
    data: function(){
        return {
            cierres: [],
        }
    },
    created: function(){
        this.getCierres();
    },
    methods:{
        getCierres: function () {
            var urlCierres = './getCotisCerradas';
            axios.get(urlCierres).then(response => {
                this.cierres = response.data;
                // console.log(response.data);
            })
        },
        setGastos: function(cierre){
            var url = './setGastos/'+cierre.codiCotiFinal;
            window.location.href = url;
            // console.log("Mostrar gastos - url es :" + url);
        },
        getMerca: function(cierre){
            var url = './getMerca/'+cierre.codiCotiFinal;
            window.location.href = url;
            // console.log(url);
        },
        addGastos: function(cierre){
            var url = './storeGastoCierre/'+cierre.codiCotiFinal;
            console.log(url);
        }
    }
});
// Código vuejs para listar todos los cierres de cotizaciones
new Vue({
    el: '#cierres'
});