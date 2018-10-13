new Vue({
    el: '#utilidades',
    data:{
        utilidades:[],
        txtFechaInicio:'',
        txtFechaFinal:''
    },
    methods: {
        getUtilidades: function () {
            var urlUtilidades = '/getUtilidades';
            axios.post(urlUtilidades, {
                txtFechaInicio: this.txtFechaInicio,
                txtFechaFinal: this.txtFechaFinal
            }).then(response => {
                this.utilidades = response.data;
                console.log(response.data);
            })
        },
        reporteExcel: function () {
            var urlUtilidades = '/utilidadesExcel';
            axios.post(urlUtilidades, {
                txtFechaInicio: this.txtFechaInicio,
                txtFechaFinal: this.txtFechaFinal
            }).then(response => {
                // console.log(response.data);
            })
        }
    }
});