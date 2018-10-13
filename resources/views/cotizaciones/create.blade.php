@extends ('layouts.admin')
@section ('contenido')
	<style type="text/css">

		.panel-produc {
			background-color: #DCFEDA;
		}

		.cost_mod {
			background-color: #D8FFE8;
		}

	</style>
	<div class="row">
		<nav>
			<ol class="breadcrumb">
				<li class="breadcrumb-item">
					<a href="{{ url('cotizaciones') }}">Cotizaciones</a>
				</li>
				<li class="breadcrumb-item active">
					Cotización
				</li>
			</ol>
		</nav>
	</div>
	<div class="container-fluid">
		<div class="row">
			@if(count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif
		</div>
		<div class="row">
			<div class="col-md-10">
				<div class="page-header">
					<h1>
						COTIZACIONES <small>Nuevo</small>
					</h1>
				</div>
			</div>
			<div class="col-md-2">
				<center>Código Cotización</center>
				@if(isset($coti_continue))
				<input type="text" disabled name="txtNumCoti" class="form-control" value="{{ $coti_continue->numCoti }}" style="text-align: center;">
				@else
				<input type="text" disabled name="txtNumCoti" class="form-control" value="{{ $dataCotizacion->numCoti}}" style="text-align: center;">
				@endif
			</div>
		</div>

		@include('cotizaciones.costeo')

	</div>

	{{--@include('cotizaciones.modalRegistros')--}}

<script>
    $(document).ready(function() {
        var cc = parseInt($("#txt_total_costeos").val());
		var sumT = 0;
		var sumU = 0;
		var sumM = 0;
        var totalCosto = 0.0;
        var totalCostoDolar = 0.0;
        var totalMargenCosto = 0.0;
        var cambio = $("#txt_dolar").val();
        var igv = $("#txt_igv").val();

		$('.calCot').each(function(){
		    var num1 = $(this).val();
		    sumT += parseFloat(num1);
		});
        $('.calUti').each(function(){
            var num2 = $(this).val();
            sumU += parseFloat(num2);
        });
        $('.calMargen').each(function(){
            var num3 = $(this).val();
            sumM += parseFloat(num3) / cc;
        });

        $('.totalCostos').each(function(){
            var num4 = $(this).val();
            totalCosto += parseFloat(num4);
        });

        $('.costoTotalDolares').each(function(){
            var num5 = $(this).val();
            totalCostoDolar += parseFloat(num5);
        });

        $('.mCosto').each(function(){
            var num6 = $(this).val();
            totalMargenCosto += parseFloat(num6) / cc;
        });

        $('.cost_mod').keyup(function () {
            for (var i = 1; i <= cc; i++) {
                if ($(this).attr('name') === 'txt_cantidad' + i || $(this).attr('name') === 'txt_cus_dolar_sin' + i || $(this).attr('name') === 'txt_margen_cu_soles' + i) {
                    var txt_cantidad = "#txt_cantidad" + i;
                    var txt_cus_dolar_sin = "#txt_cus_dolar_sin" + i;
                    var txt_cus_dolar = "#txt_cus_dolar" + i;
                    var txt_total_dolar = "#txt_total_dolar" + i;
                    var txt_cus_soles = "#txt_cus_soles" + i;
                    var txt_total_soles = "#txt_total_soles" + i;
                    var txt_margen_cu_soles = '#txt_margen_cu_soles' + i;
                    var txt_pu_soles = '#txt_pu_soles' + i;
                    var txt_pu_total_soles = '#txt_pu_total_soles' + i;
                    var txt_utilidad_u = '#txt_utilidad_u' + i;
                    var txt_margen_u = '#txt_margen_u' + i;

                    var cantidad = $(txt_cantidad).val();
                    var precioSinIgv = $(txt_cus_dolar_sin).val();

                    var totalDolaresCon = precioSinIgv * (parseFloat(igv) + 1);
                    var totalDolares = totalDolaresCon * cantidad;

                    var totalSolesInc = precioSinIgv * cambio * (parseFloat(igv) + 1);
                    var totalSoles = totalSolesInc * cantidad;

                    //montos en dolares
                    $(txt_cus_dolar).val(parseFloat(totalDolaresCon).toFixed(2));
                    $(txt_total_dolar).val(parseFloat(totalDolares).toFixed(2));

                    //montos en soles
                    $(txt_cus_soles).val(parseFloat(totalSolesInc).toFixed(2));
                    $(txt_total_soles).val(parseFloat(totalSoles).toFixed(2));

                    var margenCuSoles = $(txt_margen_cu_soles).val();//1.35
                    var pus = (margenCuSoles * totalSoles)/cantidad;

                    $(txt_pu_soles).val(parseFloat(pus).toFixed(2));

                    var ventaTotal = pus * cantidad;
                    var uti = ventaTotal - totalSoles;
                    var margen = (uti * 100) / ventaTotal;

                    $(txt_pu_total_soles).val(parseFloat(ventaTotal).toFixed(2));

                    $(txt_utilidad_u).val(parseFloat(uti).toFixed(2));

                    $(txt_margen_u).val(parseFloat(margen).toFixed(2));
                    calcSumas();
                }
                if ($(this).attr('name') === 'txt_pu_soles' + i ) {

                    var txt_cantidad = "#txt_cantidad" + i;
                    var txt_cus_dolar_sin = "#txt_cus_dolar_sin" + i;
                    var txt_margen_cu_soles = '#txt_margen_cu_soles' + i;
                    var txt_cus_dolar = "#txt_cus_dolar" + i;
                    var txt_total_dolar = "#txt_total_dolar" + i;
                    var txt_cus_soles = "#txt_cus_soles" + i;
                    var txt_total_soles = "#txt_total_soles" + i;
                    var txt_pu_soles = '#txt_pu_soles' + i;
                    var txt_pu_total_soles = '#txt_pu_total_soles' + i;
                    var txt_utilidad_u = '#txt_utilidad_u' + i;
                    var txt_margen_u = '#txt_margen_u' + i;

                    var cantidad = parseFloat($(txt_cantidad).val());
                    var totalPuSoles = $(txt_pu_soles).val();
                    $(txt_pu_total_soles).val((totalPuSoles * cantidad).toFixed(2));
                    utilidad = parseFloat($(txt_pu_total_soles).val()) - parseFloat($(txt_total_soles).val());
                    margen = (utilidad * 100)/ parseFloat($(txt_pu_total_soles).val());
                    $(txt_utilidad_u).val(utilidad.toFixed(2));
                    $(txt_margen_u).val(margen.toFixed(2));

                    calcSumas();
                }
            }
        });


        function calcSumas(){
            var c = parseInt($("#txt_total_costeos").val());
            var vt = 0.0;
            var ut = 0.0;
            var sub_mt = 0.0;
            for (var i = 1; i < c + 1; i++) {
                vt += parseFloat($('#txt_pu_total_soles'+i).val());
                ut += parseFloat($('#txt_utilidad_u'+i).val());
                sub_mt += parseFloat($('#txt_margen_u'+i).val());
            }
            var mt = sub_mt / c;

            $('#txt_ventaTotal').val(vt.toFixed(2));
            $('#txt_utilidadTotal').val(ut.toFixed(2));
            $('#txt_margenTotal').val(mt.toFixed(2));
        }

        //sumas totales
        $('.totalCosto').val(totalCosto.toFixed(2));
        $('.totalCostoDolar').val(totalCostoDolar.toFixed(2));
        $('.margenCosto').val(totalMargenCosto.toFixed(2));
		$('.totCal').val(sumT.toFixed(2));
        $('.totUti').val(sumU.toFixed(2));
        $('.totMargen').val(sumM.toFixed(2));
    });
</script>

<script>
    var editor_config = {
        path_absolute : "/",
        selector: ".txt_imagen",
        height: 300,
        oninit : "setPlainText",
        images_upload_base_path: '/imagenes/productos',
        plugins: [
            "advlist autolink lists link image charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars code fullscreen",
            "insertdatetime media nonbreaking save table contextmenu directionality",
            "emoticons template paste textcolor colorpicker textpattern"
        ],
        toolbar: "image",
        relative_urls: true,
        file_browser_callback : function(field_name, url, type, win) {
            var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
            var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

            var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
            if (type == 'image') {
                cmsURL = cmsURL + "&type=Images";
            } else {
                cmsURL = cmsURL + "&type=Files";
            }

            tinyMCE.activeEditor.windowManager.open({
                file : cmsURL,
                title : 'Filemanager',
                width : x * 0.8,
                height : y * 0.8,
                resizable : "yes",
                close_previous : "no"
            });
        }
    };

    var editor_config2 = {
        selector:'.txt_descripcion',
        height:308,
        theme: 'modern',
		oninit : "setPlainText",
        menubar: true,
        plugins: ['lists link image charmap paste print preview hr anchor pagebreak wordcount emoticons template textcolor'],
        toolbar: "insertfile undo redo | sizeselect | bold italic | fontselect |  fontsizeselect  |  link image media | forecolor backcolor"
    }

    tinymce.init(editor_config);
    tinymce.init(editor_config2);
</script>

<script>
    //cargar con ajax el nombre completo de cliente
    $('#btn_buscar_dniRuc').on('click', function () {
        //registrar contacto
        datos = {
            txt_dniRuc: $('input[name=txt_cliente_ruc_dni]').val(),
        };

        $.ajax({
            type: 'GET',
			dataType: 'JSON',
            url: "{{ URL::to('getCliente') }}",
            data: datos,
            success: function (response) {
                if (response.codiClienJuri == 1){
                    $('input[name=txt_cliente]').val(response.nombreClienNatu);
                    $('input[name=txt_codiClien]').val(response.codiClien);
//                    console.log("natural");
				}else if (response.codiClienNatu == 1){
                    $('input[name=txt_cliente]').val(response.razonSocialClienJ);
                    $('input[name=txt_codiClien]').val(response.codiClien);
//                    console.log("juridico");
				}else{
                    $('input[name=txt_cliente]').val("");
				}
            },
            error: function(){
                $('input[name=txt_cliente]').val("");
			}
        });
    });

    //cargar con ajax el nombre completo de contacto
    $('#btn_getContacto').on('click', function () {
        //registrar contacto
        datos = {
            txt_atencion_ruc_dni: $('input[name=txt_atencion_ruc_dni]').val(),
        };

        $.ajax({
            type: 'GET',
            dataType: 'JSON',
            url: "{{ URL::to('getContacto') }}",
            data: datos,
            success: function (response) {
                console.log();
                $('input[name=txt_atencion]').val(response.nombreContacClien + " " + response.apePaterContacC + " " + response.apeMaterContacC);
                $('input[name=txt_codiContacClien]').val(response.codiContacClien);
            },
            error: function (error) {
                console.log(error.message)
            }
        });
    });

    //eliminar costeoItem
    $('#btn_getContacto').on('click', function () {
        //registrar contacto
        datos = {
            txt_atencion_ruc_dni: $('input[name=txt_atencion_ruc_dni]').val(),
        };

        $.ajax({
            type: 'GET',
            dataType: 'JSON',
            url: "{{ URL::to('getContacto') }}",
            data: datos,
            success: function (response) {
                console.log();
                $('input[name=txt_atencion]').val(response.nombreContacClien + " " + response.apePaterContacC + " " + response.apeMaterContacC);
                $('input[name=txt_codiContacClien]').val(response.codiContacClien);
            },
            error: function (error) {
                console.log(error.message)
            }
        });
    });

    $(function() {
//        function log( message ) {
//            $( "<div>" ).text( message ).prependTo( "#log" );
//            $( "#log" ).scrollTop( 0 );
//        }

        $( "#txt_cliente" ).autocomplete({
            source: function( request, response ) {
                $.ajax({
                    url: "{{ URL::to('getClienteCotizacion') }}",
                    dataType: "json",
                    data: {
                        name: request.term
                    },
                    success: function( data ) {
						response($.map(data, function(item){
							return{
//								id: item.codiCoti,
								value: item.nomCli,
							}
						}));
                    }
                });
            },
            minLength: 3,
//            select: function( event, ui ) {
//                $(this).val(ui.item.value);
//                $('#txt_cliente').val(ui.item.id);
//            }
        });
    });
</script>
@endsection