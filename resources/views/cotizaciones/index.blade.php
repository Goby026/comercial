@extends ('layouts.admin')
@section ('contenido')
<style type="text/css">
	input[type=checkbox] {
		cursor: pointer;
	}
</style>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1>
					COTIZACIONES <small>Busquedas</small><a href="" data-target="#modal-inicio" data-toggle="modal"><button id="btn_iniciar_cotizacion" type="submit" class="btn btn-primary pull-right">+ Nueva cotización</button></a>
				</h1>
			</div>
			@include('cotizaciones.modal')
			
			<div class="row">
				<div class="col-md-4">
					<a href="#" class="btn btn-success search-modal">Busqueda</a>
					
				</div>
				<div class="col-md-4">
					<label>
						<button type="button" class="btn btn-default">Ver cotizaciones asistidas</button>
					</label>
					
				</div>
				<div class="col-md-4">
					<a href="{{ url('asistirCoti') }}"><button class="btn btn-warning pull-right">Asistir cotización</button></a>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<table class="table">
						<thead>
							<tr>
								<th>
									Asunto
								</th>
								<th>
									Cliente
								</th>
								<th>
									Producto
								</th>
								<th>
									Fecha / Hora
								</th>
								<th>
									Creado por
								</th>
								<th>
									Estado
								</th>
								<th>
									Total
								</th>
								<th colspan="3">
									<center>Acciones</center>
								</th>
							</tr>
						</thead>
						<tbody>
							@foreach($cotizaciones as $coti)
							<tr class="active">
								<td>
									{{ $coti->asuntoCoti }}
								</td>
								
								@if( $coti->codiClienNatu != '001' )
								<td>{{ $coti->apePaterClienN }} {{ $coti->apeMaterClienN }} {{ $coti->nombreClienNatu }}
								</td>
								@else
								<td>{{ $coti->razonSocialClienJ }}</td>
								@endif
								<td>
									{{ $coti->nombreProducProveedor }}
								</td>
								<td>
									{{ $coti->fechaSistema }}
								</td>
								<td>
									{{ $coti->nombreCola }} {{ $coti->apePaterCola }} {{ $coti->apeMaterCola }}
								</td>
								<td>
									{{ $coti->nombreCotiEsta }}
								</td>
								<td>
									S/. {{ $coti->costoTotalSolesIgv }}
								</td>
								<td>
									<a href="{{ url('cotizacion',['codiCoti'=>$coti->codiCoti]) }}">Ver costeo </a>|
									<a href="{{ url('pdfCoti',['codiCoti'=>$coti->codiCoti]) }}" target="_blank">Ver cotización </a>
									@if( $coti->nombreCotiEsta == 'En construccion' )
									<a href="{{ URL::action('CotizacionController@continuar',$coti->codiCoti) }}"><button class="btn btn-info btn-xs">Continuar</button></a>
									@else
									<a href=""><button class="btn btn-success btn-xs">Reutilizar</button></a>
									@endif
								</td>
							</tr>
							@endforeach
							
						</tbody>
					</table>
					{{ $cotizaciones->render() }}
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Modal busquedas -->
<div id="searchModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<h4 class="modal-title"></h4>
			</div>
			<div class="modal-body">
				<form action="{{ url('/find_params') }}" method="GET">
					<div class="row">					
						<div class="col-md-4">
							<div class="checkbox checkbox-success">
								<input id="producto" class="styled" type="checkbox">							
								<label class="control-label" for="producto">
									Producto
								</label>
							</div>
						</div>
						<div class="col-md-8">
							<input type="text" name="txt_find_producto" id="txt_find_producto" disabled class="form-control">
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-md-4">
							<div class="checkbox checkbox-success">
								<input id="cotizacion" name="txt_find_cotizacion" class="styled" type="checkbox">
								<label class="control-label" for="cotizacion">
									N° Cotización
								</label>
							</div>						
						</div>
						<div class="col-md-8">
							<input type="text" name="txt_find_codiCoti" id="txt_find_codiCoti" disabled class="form-control">
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-md-4">
							<div class="checkbox checkbox-success">
								<input id="asunto" name="txt_find_asunto" class="styled" type="checkbox">
								<label class="control-label" for="asunto">
									Asunto
								</label>
							</div>						
						</div>
						<div class="col-md-8">
							<input type="text" name="txt_find_asunto" id="txt_find_asunto" disabled class="form-control">
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-md-4">
							<div class="checkbox checkbox-success">
								<input id="cliente" name="txt_find_cliente" class="styled" type="checkbox">
								<label class="control-label" for="cliente">
									Cliente
								</label>
							</div>
						</div>
						<div class="col-md-8">
							<input type="" name="txt_find_cliente" id="txt_find_cliente" disabled class="form-control">
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-md-4">
							<div class="checkbox checkbox-success">
								<input id="fechas" class="styled" type="checkbox">
								<label class="control-label" for="fechas">
									Fechas
								</label>
							</div>						
						</div>
						<div class="col-md-8">
							<p>
								Desde<input type="date" name="txtFechaInicio" disabled class="form-control">
						  		Hasta<input type="date" name="txtFechaFinal" disabled class="form-control">
							</p>
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-success">Iniciar busqueda</button>
						<button type="button" class="btn btn-danger" data-dismiss="modal">
							<span class='fa fa-remove'></span> Cerrar
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<script>
	// modal de busquedas
	$(document).on('click', '.search-modal', function() {
		$('.modal-title').text('Parámetros de búsqueda');
		$('#searchModal').modal('show');
	});

	$("#producto").on( 'change', function() {
	    if( $(this).is(':checked') ) {
	        // Hacer algo si el checkbox ha sido seleccionado
	        $('#txt_find_producto').prop('disabled', false);
	    } else {
	        // Hacer algo si el checkbox ha sido deseleccionado
	        $('#txt_find_producto').prop('disabled', true);
	    }
	});

	$("#cotizacion").on( 'change', function() {
	    if( $(this).is(':checked') ) {
	        // Hacer algo si el checkbox ha sido seleccionado
	        $('#txt_find_codiCoti').prop('disabled', false);
	    } else {
	        // Hacer algo si el checkbox ha sido deseleccionado
	        $('#txt_find_codiCoti').prop('disabled', true);
	    }
	});

	$("#asunto").on( 'change', function() {
	    if( $(this).is(':checked') ) {
	        // Hacer algo si el checkbox ha sido seleccionado
	        $('#txt_find_asunto').prop('disabled', false);
	    } else {
	        // Hacer algo si el checkbox ha sido deseleccionado
	        $('#txt_find_asunto').prop('disabled', true);
	    }
	});

	$("#cliente").on( 'change', function() {
	    if( $(this).is(':checked') ) {
	        // Hacer algo si el checkbox ha sido seleccionado
	        $('#txt_find_cliente').prop('disabled', false);
	    } else {
	        // Hacer algo si el checkbox ha sido deseleccionado
	        $('#txt_find_cliente').prop('disabled', true);
	    }
	});

	$("#fechas").on( 'change', function() {
	    if( $(this).is(':checked') ) {
	        // Hacer algo si el checkbox ha sido seleccionado
	        $('#txtFechaInicio').prop('disabled', false);
	        $('#txtFechaFinal').prop('disabled', false);
	    } else {
	        // Hacer algo si el checkbox ha sido deseleccionado
	        $('#txtFechaInicio').prop('disabled', true);
	        $('#txtFechaFinal').prop('disabled', true);
	    }
	});
	

</script>
@endsection