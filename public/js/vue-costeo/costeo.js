
// Vue.component('test-component', {
//     props: {
//         name: String,
//         desc: String
//     },
//     template: `<div>
//                     <p>{{ name }}</p>
//                     <p>{{ desc }}</p>
//                 </div>`
// });

Vue.directive('tinymce', {
    twoWay: true,
    inserted(element) {
        tinymce.init({
            target: element,
            theme: 'modern',
            plugins: 'image media link code imagetools textcolor colorpicker',
            api_key: 'YOUR_API_KEY',
            height: 400,
            // width: 1000,
            tinydrive_token_provider: 'URL_TO_YOUR_TOKEN_PROVIDER',
            toolbar: ' forecolor backcolor | sizeselect | bold italic | fontselect |  fontsizeselect | alignleft aligncenter alignright alignjustify',
            setup: function(editor) {
                editor.on('blur', function( element ) {

                    // console.log('TEXTO', tinyMCE.activeEditor.getContent());
                    //
                    // console.log('ID', element.target.id);

                    var idCosteoItem = element.target.id;
                    var descCosteoItem = tinyMCE.activeEditor.getContent();

                    console.log('id', idCosteoItem);
                    console.log('descripcion', descCosteoItem);

                    datos = {
                        '_token': $('input[name=_token]').val(),
                        idCosteoItem: idCosteoItem,
                        descCosteoItem: descCosteoItem
                    }

                    $.ajax({
                        type: 'POST',
                        url: "/updateDescCosteoItem",
                        data: datos,
                        success: function (response) {
                            console.log(response);
                        }
                    });
                });
            }
        })
    }
});

new Vue({
    el: '#costeo',
    element: 'textarea',
    created: function () {
        this.getData();
        this.getItems();
    },
    data: {
        codiCoti: document.querySelector("input[name=_coti]").value,
        cantidad: 1,
        igv:0.18,
        dolar:3.45,
        costeos: [],
        items: [],
        prods: [],
        totales:{
            totalCot:0.0,
            totalUtilidad:0.0,
            totalMargen:0.0
        },
        proveedores: [],
        totalCosteos:0,
        errors: []
    },
    methods: {
        getData: function() {
            var url = '/getData/'+this.codiCoti;
            axios.get(url).then( response => {
                console.log('costeo', response.data.data.costeos);
                this.costeos = response.data.data.costeos;
                this.proveedores = response.data.data.proveedores;
                this.totalCosteos = this.costeos.length;
                this.setTotales();
            });
        },
        getItems: function() {

            var url = '/getItems/'+this.codiCoti;
            axios.get(url).then( response => {

                // this.costeos.push(response.data.data.items);
                this.prods = response.data.data.prods;
                this.items = response.data.data.items;
                console.log("items",this.items);
                console.log("prods",this.prods);
            });

        },
        operar: function (costeo) {
            //método para realizar los calculos matemáticos del costeo
            var costoUd = parseFloat(costeo.precioProducDolar) * (1 + parseFloat(this.igv));
            var total_D = costoUd * costeo.cantiCoti;
            var cu_S = costoUd * parseFloat(this.dolar);
            var total_S = cu_S * costeo.cantiCoti;
            var pu_S = cu_S * costeo.margenCoti;
            var _total = pu_S * costeo.cantiCoti;
            var _utilidad = _total - total_S;
            var _margen = (_utilidad * 100) / _total;

            costeo.costoUniIgv = costoUd.toFixed(2);
            costeo.costoTotalIgv = total_D.toFixed(2);
            costeo.costoUniSolesIgv = cu_S.toFixed(2);
            costeo.costoTotalSolesIgv = total_S.toFixed(2);
            costeo.precioUniSoles = pu_S.toFixed(2);
            costeo.precioTotal = _total.toFixed(2);
            costeo.utiCoti = _utilidad.toFixed(2);
            costeo.margenVentaCoti = _margen.toFixed(2);

            // this.operar_pus(costeo);

            this.setTotales();
        },
        setTotales: function () {
            let _total = 0.0;
            let _totalUtilidad = 0.0;
            let _totalMargen = 0.0;

            this.items.forEach(function (element) {
                _total += parseFloat(element.precioTotal);
                _totalUtilidad += parseFloat(element.utiCoti);
                _totalMargen += parseFloat(element.margenVentaCoti);
            });

            this.totales.totalCot = _total.toFixed(2);
            this.totales.totalUtilidad = _totalUtilidad.toFixed(2);
            this.totales.totalMargen = (_totalMargen / this.costeos.length).toFixed(2);
            //
            // this.total = this.totales.totalCot * this.cantidad;
        },
        operar_pus: function (costeo) {

            var costoUd = parseFloat(costeo.precioProducDolar) * (1 + parseFloat(this.igv));

            //funcion para actualizar los precios TOTALES de toda la cotizacion
            var _total = costeo.precioUniSoles * parseFloat(costeo.cantiCoti);
            var _utilidad = _total - ((costoUd * parseFloat(this.dolar)) * costeo.cantiCoti);
            var _margentotal = (_utilidad * 100) / _total;


            costeo.precioTotal = _total.toFixed(2);
            costeo.utiCoti = _utilidad.toFixed(2);
            costeo.margenVentaCoti = _margentotal.toFixed(2);

            this.setTotales();
        },
        addItemCosteo: function(codiCosteo){

            var url = '/addItem';
            axios.post(url, {
                codiCosteo : codiCosteo
            }).then( response => {
                console.log(response);
                this.getData();
                this.getItems();
                Swal.fire({
                    title: 'OK!',
                    text: 'Se agregó nuevo elemento de kit',
                    type: 'success',
                    confirmButtonText: 'OK'
                })
            }).catch(error =>{
                this.errors = error.response.data;
                console.log(this.errors);
            });

        },
        newCosteo: function(tipo){

            var url = "/storeCosteo";
            axios.post(url, {
                codiCoti : this.codiCoti,
                tipoCosteo: tipo
            }).then( response => {
                console.log(response);
                this.getData();
                this.getItems();
            }).catch(error =>{
                this.errors = error.response.data;
                console.log(this.errors);
            });

        },
        saveCosteo: function(item){

            console.log(item);
            // Swal.fire({
            //     title: 'OK!',
            //     text: 'Se guardaron los datos',
            //     type: 'success',
            //     confirmButtonText: 'Continuar'
            // })
        },
        handleBlur: function(item) {
            var url = "/costeoUpdate";
            axios.post(url, {
                item : item
            }).then( response => {

            }).catch(error =>{
                this.errors = error.response.data;
                console.log(this.errors);
            });
        }
        // saveIdProveedor: function(event, idCosteoItem){
        //     var codiProveedor = event.target.value;
        //     var url = "/updateProveedorId";
        //     axios.post(url, {
        //         idCosteoItem : idCosteoItem,
        //         codiProveedor: codiProveedor
        //     }).then( response => {
        //         console.log(response);
        //     }).catch(error =>{
        //         this.errors = error.response.data;
        //         console.log(this.errors);
        //     });
        // }
        // ,
        // saveItem: function(item){
        //     var url = "/costeoUpdate";
        //     axios.post(url, {
        //         item : item
        //     }).then( response => {
        //         console.log(response);
        //     }).catch(error =>{
        //         this.errors = error.response.data;
        //         console.log(this.errors);
        //     });
        // }
        ,
        deleteItem: function(idCosteoItem){

            Swal.fire({
                title: 'Esta seguro?',
                text: "No podra revertir lo que elimina!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, borrarlo!'
            }).then((result) => {
                if (result.value) {
                    var url = '/delCosteoItem/'+idCosteoItem;
                    axios.post(url).then( response => {
                    });
                    Swal.fire(
                        'Borrado!',
                        'El item fue borrado correctamente.',
                        'success'
                    );
                    this.getItems();
                }
            });

            console.log("id", idCosteoItem);
        },
        setDolar: function(){
            Swal.fire({
                title: 'OK!',
                text: 'Se guardaron los datos',
                type: 'success',
                confirmButtonText: 'Continuar'
            })
        }
    }

});
