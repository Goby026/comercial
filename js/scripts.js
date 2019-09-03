var vm = new Vue({
    el: '#colaboradores',
    created: function(){
        this.getCotizaciones();
    },
    data: {
        colaboradores: []
    },
    methods: {
        getCotizaciones: function(){
            var vm = this;
            var urlSistemas = './pruebas';
            axios.get(urlSistemas).then( response => {
                vm.colaboradores = response.data
                //console.log(response.data);
            });
        }
    }

});


// $(document).ready(function(){
//
//     $.ajax({
//         type: 'GET',
//         dataType: 'JSON',
//         url: "/pruebas",
//         // data: datos,
//         success: function (response) {
//             console.log(response);
//             // $('input[name=txt_atencion]').val(response.nombreContacClien + " " + response.apePaterContacC + " " + response.apeMaterContacC);
//             // $('input[name=txt_codiContacClien]').val(response.codiContacClien);
//         },
//         error: function (error) {
//             console.log(error.message)
//         }
//     });
//
// });