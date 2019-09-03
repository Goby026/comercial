new Vue({
    el: '#costeo',
    created: function () {
        this.saludar();
        // this.getData();
        // this.getCoti();
    },
    data: {
        // codiCoti: document.querySelector("input[name=_coti]").value,
        codiCosteo: '',
        mensaje: "Costeo VUE",
        dolar: 3.45,
        igv: 0.18,
        costeoItem: {
            idCosteoItem:'',
            itemCosteo:'',
            descCosteoItem:'',
            codInterno:'',
            codProveedor:'',
            margencus: 1.3,
            cantidad: 1,
            cudsin: 0.0,
            cud: 0.0,
            totald: 0.0,
            cus: 0.0,
            totals: 0.0,
            pus: 0.0,
            total: 0.0,
            utilidad: 0.0,
            margenfinal: 0.0
        },
        totales:{
            totalCot: 0,
            totalUtilidad: 0,
            totalMargen: 0,
            detalle: "",
            imagen: ""
        },
        errors: []
    },
    methods: {
        saludar: function(){
            console.log(this.mensaje);
        },
        getData: function(){
            //metodo para obtener el valor del dolar e igv
            var url = '../getData';
            axios.get(url).then( response => {
                this.dolar = response.data.data.dolar.dolarVenta;
                this.igv = (response.data.data.igv.valorIgv)/100;

                console.log(this.dolar, this.igv);

            });
        },
        getCoti: function(){
            //metodo para recuperar informacion de la cotizacion
            var url = '../getDataCoti/'+this.codiCoti;
            axios.get(url).then( response => {
                console.log(response.data.data);
                this.costeoItem.itemCosteo = response.data.data.costeoItem.itemCosteo;
                this.costeoItem.codInterno = response.data.data.costeoItem.codInterno;
                this.costeoItem.codProveedor = response.data.data.costeoItem.codProveedor;
                this.costeoItem.descCosteoItem = response.data.data.costeoItem.descCosteoItem;
            });
        },
        operar: function (data) {
            //método para realizar los calculos matemáticos del costeo
            var costoUd = parseFloat(data.cudsin) * (1 + parseFloat(this.igv));
            var total_D = costoUd * data.cantidad;
            var cu_S = costoUd * parseFloat(this.dolar);
            var total_S = cu_S * data.cantidad;
            var pu_S = cu_S * data.margencus;
            var _total = pu_S * data.cantidad;
            var _utilidad = _total - total_S;
            var _margen = (_utilidad * 100) / _total;

            this.costeoItem.cud = costoUd.toFixed(2);
            this.costeoItem.totald = total_D.toFixed(2);
            this.costeoItem.cus = cu_S.toFixed(2);
            this.costeoItem.totals = total_S.toFixed(2);
            this.costeoItem.pus = pu_S.toFixed(2);
            this.costeoItem.total = _total.toFixed(2);
            this.costeoItem.utilidad = _utilidad.toFixed(2);
            this.costeoItem.margenfinal = _margen.toFixed(2);

            // this.operar_pus();

            // this.cambiar(parte);
        },
        cambiar: function (data) {
            var _total = data.pus * parseFloat(data.cantidad);
            var _utilidad = _total - data.totals;
            var _margentotal = (_utilidad * 100) / _total;

            this.costeoItem.total = _total.toFixed(2);
            this.costeoItem.utilidad = _utilidad.toFixed(2);
            this.costeoItem.margenfinal = _margentotal.toFixed(2);

            this.operar_pus();
        },
        operar_pus: function () {

            let _total = 0.0;
            let _totalUtilidad = 0.0;
            let _totalMargen = 0.0;

            // this.partesCoti.forEach(function (element) {
            //     _total += parseFloat(element.total);
            //     _totalUtilidad += parseFloat(element.utilidad);
            //     _totalMargen += parseFloat(element.margenfinal);
            // });

            this.totales.totalCot = _total.toFixed(2);
            this.totales.totalUtilidad = _totalUtilidad.toFixed(2);
            this.totales.totalMargen = (_totalMargen / this.partes.length).toFixed(2);

            this.total = this.totales.totalCot * this.cantidad;
        },
        addCosteo: function(){
            var url = "../storeCosteo";
            axios.post(url, null).then( response => {
                this.codiCosteo = response.data.data.costeo.codiCosteo;

            }).catch(error =>{
                this.errors = error.response.data;
                console.log(this.errors);
            });
        },
        addCotiCosteo: function(codiCosteo) {
            var url = "../addCotiCosteo";
            this.addCosteo();
            axios.post(url, {
                codiCoti : this.codiCoti,
                codiCosteo: codiCosteo
            }).then( response => {
                console.log(response);
            }).catch(error =>{
                this.errors = error.response.data;
                console.log(this.errors);
            });
        },
        saveData: function(){
            alert("Costeo guardado");
        }

    }
});
