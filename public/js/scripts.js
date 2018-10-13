new Vue({
    el: '#colaboradores',
    created: function(){
        this.getCotizaciones();
    },
    data: {
        colaboradores: [],
        suma : 0
    },
    methods: {
        getCotizaciones: function(){
            var urlSistemas = '/pruebas';
            axios.get(urlSistemas).then( response => {
                this.colaboradores = response.data
            });
        },
        deleteSistema: function(sistema){
            var url = '/sistemas/'+sistema.id;
            axios.delete(url).then( response=> {
                this.getSistemas();
        });
        }

    }

});