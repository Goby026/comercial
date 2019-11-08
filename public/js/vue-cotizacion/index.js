Vue.component('new-cotizacion',{
    created: function() {

    },
    data: function(){
        return {

        }
    },
    methods:{

        setTipoItem: async function(){

            const { value: fruit } = await Swal.fire({
                title: 'Tipo de costeo',
                input: 'select',
                inputOptions: {
                    producto: 'Producto',
                    kit: 'Kit'
                },
                // inputPlaceholder: 'Seleccione el tipo de costeo inicial',
                showCancelButton: true,
                inputValidator: (value) => {
                    return new Promise((resolve) => {
                        if (value === 'producto') {
                            // window.location.href = '/home';
                            axios.post('/cotizaciones',{
                                tipoCosteo: 0
                            })
                            .then( (response)=>{
                                window.location.href = '/continuar/'+response.data.data.cotizacion.codiCoti;
                                // console.log(response.data.data.cotizacion.codiCoti);
                            })
                            .catch(error =>{
                                console.log(error);
                            });

                            resolve();
                        } else if (value === 'kit') {
                            axios.post('/cotizaciones', {
                                tipoCosteo: 1
                            }).then( response => {
                                window.location.href = '/continuar/'+response.data.data.cotizacion.codiCoti;
                            }).catch(error =>{
                                console.log(error);
                            });
                            resolve();
                        }
                    })
                }
            })

            // if (fruit) {
            //     Swal.fire('You selected: ' + fruit)
            // }

        }

    },
    template:
        `<div class="page-header">
            <h1>
            COTIZACIONES <small>Panel principal</small>
            <button v-on:click="setTipoItem()" type="button" class="btn btn-primary pull-right"><i class="fa fa-plus-square"></i> Nueva cotización</button>
            </h1>
        </div>`
});


new Vue({el: '#newcoti'});
