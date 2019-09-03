@extends ('layouts.admin')
@section ('contenido')
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
				<center># Cotización</center>
				@if(isset($coti_continue))
				<input type="text" disabled name="txtNumCoti" class="form-control" value="{{ $coti_continue->numCoti }}" style="text-align: center;">
				@else
				<input type="text" disabled name="txtNumCoti" class="form-control" value="{{ $dataCotizacion->numCoti}}" style="text-align: center;">
				@endif
			</div>
		</div>

		@include('cotizaciones.costeo')

	</div>

	@include('cotizaciones.modalRegistros')

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
    {{--$('#btn_getContacto').on('click', function () {--}}
        {{--//registrar contacto--}}
        {{--datos = {--}}
            {{--txt_atencion_ruc_dni: $('input[name=txt_atencion_ruc_dni]').val(),--}}
        {{--};--}}

        {{--$.ajax({--}}
            {{--type: 'GET',--}}
            {{--dataType: 'JSON',--}}
            {{--url: "{{ URL::to('getContacto') }}",--}}
            {{--data: datos,--}}
            {{--success: function (response) {--}}
                {{--console.log();--}}
                {{--$('input[name=txt_atencion]').val(response.nombreContacClien + " " + response.apePaterContacC + " " + response.apeMaterContacC);--}}
                {{--$('input[name=txt_codiContacClien]').val(response.codiContacClien);--}}
            {{--},--}}
            {{--error: function (error) {--}}
                {{--console.log(error.message)--}}
            {{--}--}}
        {{--});--}}
    {{--});--}}
</script>
@endsection