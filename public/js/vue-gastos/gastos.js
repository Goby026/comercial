new Vue({
    el: '#gastos',
    data:{
        gastos:'',
        codiCotiFinal: "",
        numCotizacion: "",
        nomCli:"",
        detalles:[],
        total:0
    },
    created: function(){
        this.getSistemas();
    },
    methods: {
        getSistemas: function () {
            var urlGastos = './getGastos';
            axios.get(urlGastos).then(response => {
                this.gastos = response.data;
                console.log(response.data);
        })
        },
        editGasto: function(gasto) {

            this.numCotizacion = gasto.numCoti;
            this.nomCli = gasto.nomCli;

            var url = './getDetalleGasto/'+gasto.codiCotiFinal;

            axios.get(url).then(response => {

                this.detalles = response.data.data.detalles;
                response.data.data.detalles.forEach((e) => {
                        this.total += parseFloat(e.montoDetaGasto);
                    }
                );
                console.log(response.data);

            });
        },
        reset: function () {
            // this.gastos='';
            // this.codiCotiFinal= "";
            this.numCotizacion= "";
            this.nomCli="";
            // this.detalles=[];
            this.total=0;
        }
    }
});