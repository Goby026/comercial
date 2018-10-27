new Vue({
    el: '#condicionesComerciales',
    created: function(){
        // console.log(this.codiCoti);
        this.getCondiciones();
    },
    data: {
        condiciones: [],
        codiCondiComer:'',
        codiCoti: document.querySelector("input[name=codiCoti]").value,
        descripcion:'',
        estado:'',
        condicion:{
            idTCotiCondiciones:'',
            codiCondiComer:'',
            codiCoti:'',
            descripcion: '',
            estado:''
        }
    },
    methods: {
        getCondiciones: function(){
            var urlCondiciones = '/getCondiciones/'+this.codiCoti;
            axios.get(urlCondiciones).then( response => {
                this.condiciones = response.data;
                console.log(this.condiciones);
        });
        },
        deleteCondicion: function(condicion){
            var url = '/delCondicion/'+condicion.idTCotiCondiciones;
            axios.post(url).then( response => {
                this.getCondiciones();
            // toastr.success('Eliminado correctamente');
        });
        },
        createCondicion: function(){
            var url = "/createCondicion";
            axios.post(url, {
                codiCoti: this.codiCoti,
                descripcion: this.descripcion
            }).then( response => {
                this.getCondiciones();
                this.codiCondiComer='';
                this.descripcion='',
                this.estado='',
            // this.errors = [],
                $('#modalNuevo').modal('hide');
            // toastr.success('Nuevo sistema creado');
        } ).catch(error =>{
                this.errors = error.response.data;
        });
        },
        editCondicion: function(cond){
            // this.sistema.codiSistema = condicion.codiSistema;
            // this.sistema.nombreSiste = condicion.nombreSiste;
            // this.sistema.nombreBreveSiste = condicion.nombreBreveSiste;
            // this.sistema.fechaCreaSiste = condicion.fechaCreaSiste;
            this.condicion.idTCotiCondiciones = cond.idTCotiCondiciones;
            this.condicion.codiCondiComer = cond.codiCondiComer;
            this.condicion.codiCoti = cond.codiCoti;
            this.condicion.descripcion = cond.descripcion;
            this.condicion.estado = cond.estado;
            $('#modalEdit').modal('show');
            console.log(this.condicion.idTCotiCondiciones);
        },
        updateCondicion: function(codiCondicion){
            var url = '/updateCondicion/'+codiCondicion;
            axios.post(url, this.condicion).then( response => {
                this.getCondiciones();
            // this.sistema = {
            //     codiSistema:'',
            //     nombreSiste:'',
            //     nombreBreveSiste:'',
            //     fechaCreaSiste:'',
            //     estaSiste:''
            // };
            this.errors = [];
            $('#modalEdit').modal('hide');
            // toastr.success('Sistema actualizado');
        }).catch( error=>{
                this.errors = error.response.data
        });
        },
        changePage: function(page){
            this.pagination.current_page = page;
            this.getSistemas(page);
        }
    }


});