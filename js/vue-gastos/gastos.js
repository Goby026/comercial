new Vue({
    el: '#gastos',
    data:{
        gastos:'',
        detalle:{

        }
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
        }
    }
});