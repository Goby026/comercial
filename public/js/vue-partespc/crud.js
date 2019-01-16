new Vue({
    el: '#pc',
    created: function(){
        this.getPartes();
    },
    data: {
        title: 'PARTES DE PC',
        partes: [],
        mensaje: '',
        index:1,
        // costeos:[
        //     {id:1,cantidad:0,cus:0,ts:0},
        //     {id:2,cantidad:0,cus:0,ts:0},
        //     {id:3,cantidad:0,cus:0,ts:0},
        //     {id:4,cantidad:0,cus:0,ts:0},
        //     {id:5,cantidad:0,cus:0,ts:0}
        // ],
        partePc: {
            codiParte: '',
            nombre: '',
            descripcion: '',
            icono: '',
            estado: ''
        }
    },
    methods: {
        getPartes: function () {
            var urlPartes = '../getPartes';
            axios.get(urlPartes).then(response => {
                this.partes = response.data.data.partes;
                // this.total = parseInt(this.num1) + parseInt(this.num2);
                console.log(this.partes);
            })
        },
        saveParte: function(){
            var url = "../saveParte";
            axios.post(url, {
                nombre: this.partePc.nombre,
                descripcion: this.partePc.descripcion,
                icono: this.partePc.icono,
                estado: 1
            }).then( response => {
                this.getPartes();
                this.clean();
                $('#modalPartes').modal('hide');
                // toastr.success('Nuevo sistema creado');
            }).catch(error =>{
                this.errors = error.response.data;
            });

            // console.log(this.partePc.nombre);
        },
        editParte: function(parte){         //el método editParte sirve para setear los datos
            this.partePc.codiParte = parte.codiParte;
            this.partePc.nombre = parte.nombre;
            this.partePc.descripcion = parte.descripcion;
            this.partePc.icono = parte.icono;
            this.partePc.estado = parte.estado;
            console.log(this.partePc.descripcion);
        },
        updateParte: function(codiParte){
            var url = '../updateParte/'+codiParte;
            axios.post(url, this.partePc).then( response => {
                this.getPartes();
                this.errors = [];
                $('#modalEditar').modal('hide');
                this.clean();
                // toastr.success('Sistema actualizado');
            }).catch( error=>{
                this.errors = error.response.data
            });
        },
        clean: function(){
            this.partePc.codiParte = "";
            this.partePc.nombre = "";
            this.partePc.descripcion = "";
            this.partePc.icono = "";
            this.partePc.estado = "";
        }
    }
});