Vue.directive('tinymce', {
    twoWay: true,
    inserted(element) {
        tinymce.init({
            target: element,
            theme: 'modern',
            plugins: 'image media link code imagetools textcolor colorpicker',
            api_key: 'YOUR_API_KEY',
            height: 250,
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
        this.getCosteos();
        this.getData();
        // this.getItems();
    },
    data: {
        codiCoti: document.querySelector("input[name=_coti]").value,
        cotizacion: JSON.parse(document.querySelector("input[name=cotizacion]").value),
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
        tipoCoti:0,
        mostrarTotal:0,
        mostrarDetalle: false,
        errors: []
    },
    methods: {
        getCosteos: function(){
            var url = '/getCosteos/'+this.codiCoti;
            axios.get(url).then( response => {

                this.costeos = response.data.data.costeos;
                this.items = response.data.data.items;
                this.dolar = this.cotizacion.dolar;
                this.igv = this.cotizacion.igv;

                console.log('COSTEOS', this.costeos);
                console.log('ITEMS', this.items);

            });
        },
        getData: function() {
            var url = '/getData/'+this.codiCoti;
            axios.get(url).then( response => {
                this.proveedores = response.data.data.proveedores;
                this.setTotales();
            });
        },
        getItems: function() {

            var url = '/getItems/'+this.codiCoti;
            axios.get(url).then( response => {
                // this.costeos.push(response.data.data.items);
                this.prods = response.data.data.prods;
                this.items = response.data.data.items;
            });

        },
        operar: function (item, costeo) {
            //método para realizar los calculos matemáticos del costeo
            var costoUd = parseFloat(item.precioProducDolar) * (1 + parseFloat(this.igv));
            var total_D = costoUd * item.cantiCoti;
            var cu_S = costoUd * parseFloat(this.dolar);
            var total_S = cu_S * item.cantiCoti;
            var pu_S = cu_S * item.margenCoti;
            var _total = pu_S * item.cantiCoti;
            var _utilidad = _total - total_S;
            var _margen = (_utilidad * 100) / _total;

            var _precioKit = 0.0;
            var _utiKit = 0.0;
            var _margenKit = 0.0;
            var c = 0;

            item.costoUniIgv = costoUd.toFixed(2);
            item.costoTotalIgv = total_D.toFixed(2);
            item.costoUniSolesIgv = cu_S.toFixed(2);
            item.costoTotalSolesIgv = total_S.toFixed(2);
            item.precioUniSoles = pu_S.toFixed(2);
            item.precioTotal = _total.toFixed(2);
            item.utiCoti = _utilidad.toFixed(2);
            item.margenVentaCoti = _margen.toFixed(2);

            this.items.forEach(function (element) {
                if (item.codiCosteo == element.codiCosteo){
                    c++;
                    _precioKit += parseFloat(element.precioTotal);
                    _utiKit += parseFloat(element.utiCoti);
                    _margenKit += parseFloat(element.margenVentaCoti);
                    console.log('item del costeo: ', element.codiCosteo);
                }
            });

            costeo.totalVentaSoles = _precioKit.toFixed(2);
            costeo.utilidadVentaSoles = _utiKit.toFixed(2);
            costeo.margenVenta = (_margenKit / c).toFixed(2);

            // this.operar_pus(costeo);

            // console.log("uptodate",costeo);

            // this.setTotales();
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
        addItemCosteo: function(codiCosteo){

            var url = '/addItem';
            axios.post(url, {
                codiCosteo : codiCosteo
            }).then( response => {
                console.log(response);
                Swal.fire({
                    title: 'OK!',
                    text: 'Se agregó nuevo elemento de kit',
                    type: 'success',
                    confirmButtonText: 'OK'
                });

                this.getItems();

            }).catch(error =>{
                this.errors = error.response.data;
                console.log(this.errors);
            });

        },
        saveCosteo: function(){

            console.log();
            Swal.fire({
                title: 'OK!',
                text: 'Se guardaron los datos',
                type: 'success',
                confirmButtonText: 'Continuar'
            });
        },
        updateCotizacion: function(){

            // var url = "/updateCotizacion/"+this.codiCoti;
            // axios.post(url, {
            //     codiCoti : this.codiCoti,
            //     tipoCosteo: tipo
            // }).then( response => {
            //     this.getData();
            //     this.getItems();
            // }).catch(error =>{
            //     this.errors = error.response.data;
            // });

            console.log('tipo cotizacion: ', this.tipoCoti);
            console.log('¿Mostrar total?', this.tipoCoti);

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
        },
        updateCosteo: function(costeo){
            var url = "/updateCosteo";
            axios.post(url, {
                codiCosteo : costeo.codiCosteo,
                title: costeo.title
            }).then( response => {
                console.log(response);
            }).catch(error =>{
                this.errors = error.response.data;
                console.log(this.errors);
            });
        },
        deleteItem: function(idCosteoItem){

            Swal.fire({
                title: '¿Esta seguro?',
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
        delCosteo: function(codiCosteo){
            Swal.fire({
                title: '¿Esta seguro?',
                text: "Se borrarán todos los datos relacionados a este item",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, borrar!'
            }).then((result) => {
                if (result.value) {

                    axios.post('/destroyCosteo/'+codiCosteo)
                        .then((resp)=>{
                            Swal.fire(
                                'Borrado!',
                                'Su costeo se borró correctamente.',
                                'success'
                            );
                            this.getData();
                        });
                }
            });
            console.log('Costeo : ', codiCosteo);

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
                axios.put('/cotidolarigv',{
                    codiCoti: this.codiCoti,
                    dolar: this.dolar,
                    igv: this.igv
                })
                    .then(response=>{
                        console.log(response);
                    });

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
                axios.put('/cotidolarigv',{
                    codiCoti: this.codiCoti,
                    dolar: this.dolar,
                    igv: this.igv
                })
                    .then(response=>{
                        console.log(response);
                    });
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
        setTipoCotizacion: function(tipo){
            this.tipoCoti = tipo;
            console.log('Tipo Cotizacion: ', this.tipoCoti);
        },
        setMostrarTotal: function(){
            // this.mostrarTotal = mostrar;
            console.log('Mostrar total? ', this.mostrarTotal);
        },
        setMostrarDetalle: function(){
            this.mostrarDetalle = !this.mostrarDetalle;
            console.log('Mostrar: ', this.mostrarDetalle);
        }
    }

});
