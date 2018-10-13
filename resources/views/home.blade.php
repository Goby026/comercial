@extends ('layouts.admin')
@section ('contenido')
    <style>
        .btn_menu {
            height: 120px;
            width: 200px;
            align-items: center;
        }

        .btn_menu a {

        }
    </style>

    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="page-header">
                    <h1>
                        PANEL DE CONTROL
                    </h1>
                </div>
                <div class="row">
                    <center>
                        <a href="#" class="btn btn-primary btn_menu" id="btnCotizaciones"><i class="fa fa-shopping-bag"
                                                                        style="font-size: 60px; margin-top: 15px;"></i>
                            <br><label
                                    for="" style="font-size: 15px;">COTIZACIONES</label></a>
                        <a href="#" class="btn btn-warning btn_menu"><i class="fa fa-desktop"
                                                                        style="font-size: 60px; margin-top: 15px;"></i>
                            <br><label
                                    for="" style="font-size: 15px;">PRODUCTOS</label></a>
                        <a href="#" class="btn btn-success btn_menu"><i class="fa fa-truck"
                                                                        style="font-size: 60px; margin-top: 15px;"></i>
                            <br><label
                                    for="" style="font-size: 15px;">PROVEEDORES</label></a>
                        <a href="#" class="btn btn-danger btn_menu"><i class="fa fa-male"
                                                                       style="font-size: 60px; margin-top: 15px;"></i>
                            <br><label
                                    for="" style="font-size: 15px;">CLIENTES</label></a>
                    </center>
                </div>
            </div>
        </div>
        <br><br>
        <div class="row">
            <div class="col-md-4 cotis">
            </div>
            <div class="col-md-4">
            </div>
            <div class="col-md-4">
            </div>
        </div>

        <div class="row" id="colaboradores">
            <div v-for="colaborador in colaboradores">
                <label for="">@{{ colaborador.nombreCola }}</label><span class="pull-right">@{{ colaborador.cantiCoti }}</span>

                <div class="progress">
                    <div class="progress-bar progress-bar-danger progress-bar-striped" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"
                         v-bind:style="{width: colaborador.cantiCoti + '%'}">
                        <span class="sr-only">20% Complete</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--<script>--}}
        {{--//cargar con ajax los datos estadísticos de las cotizaciones--}}
        {{--$('#btnCotizaciones').on('click', function () {--}}
            {{--//registrar contacto--}}
            {{--datos = {--}}
                {{--opc: $('input[name=txt_atencion_ruc_dni]').val(),--}}
            {{--};--}}

            {{--$.ajax({--}}
                {{--type: 'GET',--}}
                {{--dataType: 'JSON',--}}
                {{--url: "{{ URL::to('estadisticas') }}",--}}
                {{--data: datos,--}}
                {{--success: function (response) {--}}
                    {{--console.log(response);--}}
{{--//                    $('input[name=txt_atencion]').val(response.nombreContacClien + " " + response.apePaterContacC + " " + response.apeMaterContacC);--}}
{{--//                    $('input[name=txt_codiContacClien]').val(response.codiContacClien);--}}
                    {{--var content ="<table class='table table-sm table-hover table-bordered'>";--}}
                    {{--content +="<tbody>";--}}
                    {{--content +="<tr>";--}}
                    {{--content +="<td>";--}}
                    {{--content +="Total cotizaciones";--}}
                    {{--content +="</td>";--}}
                    {{--content +="<td>"+ response +"</td>";--}}
                    {{--content +="</tr>";--}}
                    {{--content +="</tbody>";--}}
                    {{--content +="</table>";--}}

                    {{--$('.cotis').html(content);--}}
                {{--},--}}
                {{--error: function (error) {--}}
                    {{--console.log(error.message)--}}
                {{--}--}}
            {{--});--}}
        {{--});--}}
    {{--</script>--}}

<script>
    $(document).ready(function(){
        console.log("jquery");
    });
</script>


@endsection