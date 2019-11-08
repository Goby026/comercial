Vue.component('coti-desc',{
    created: function() {
        this.getCotizacion();
    },
    data: function(){
        return {
            codiCoti: this.coti,
            cotizacion: {}
        }
    },
    props: {
        coti:String
    },
    methods:{
        getCotizacion: function(){
            var url = '/getCoti/'+this.coti;
            axios.get(url).then( response => {

                console.log(response.data.data.cotizacion);

                this.cotizacion = response.data.data.cotizacion;

            });
        },
        updateCotizacion: function(cotizacion){
            var url = "/updateCotizacion/"+this.coti;
            axios.post(url, {
                nomCli : cotizacion.nomCli,
                nomContac : cotizacion.nomContac,
                asuntoCoti : cotizacion.asuntoCoti,
                referencia : cotizacion.referencia,
            }).then( response => {
                console.log(response);
            }).catch(error =>{
                this.errors = error.response.data;
                console.log(this.errors);
            });
        }
    },
    template:
        `<div class="container animated fadeIn">
            <div class="row">                        
                <div class="col-md-6">                        
                    <div class="form-group">
                        <label class="control-label">Cliente:</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-address-book"></i></span>
                            <input type="text" class="form-control" id="txt_cliente"
                            v-model="cotizacion.nomCli"
                            v-on:blur="updateCotizacion(cotizacion)">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">Atención:</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <input type="text" class="form-control" 
                            v-model="cotizacion.nomContac"
                            v-on:blur="updateCotizacion(cotizacion)">                                    
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label class="control-label">Asunto:</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-comment"></i></span>
                        <input type="text" class="form-control" 
                        v-model="cotizacion.asuntoCoti"
                        v-on:blur="updateCotizacion(cotizacion)">
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="control-label">Referencia:</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-file-text"></i></span>
                        <input type="text" class="form-control" 
                        v-model="cotizacion.referencia"
                        v-on:blur="updateCotizacion(cotizacion)">
                    </div>
                </div>
            </div>            
        </div>`
});


new Vue({el: '#cotizacion'});
