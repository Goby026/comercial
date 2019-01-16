@extends ('layouts.admin')
@section ('contenido')
<style type="text/css">
	input[type=checkbox] {
		cursor: pointer;
	}

	thead{
		background-color: #9f191f;
		color: #FDFDFD;
	}

</style>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1>
					COTIZACIONES <small>Busquedas</small><a href="" data-target="#modal-inicio" data-toggle="modal"><button id="btn_iniciar_cotizacion" type="button" class="btn btn-primary pull-right"><i class="fa fa-plus-square"></i> Nueva cotización</button></a>
				</h1>
			</div>
			@include('cotizaciones.modal')
			
			<div class="row">
				<div class="col-md-4">
					<a href="#" id="btn_busqueda" class="btn btn-success search-modal">Busqueda</a>
				</div>
				<div class="col-md-4">
					{{-- <label>
						<button type="button" class="btn btn-default">Ver cotizaciones asistidas</button>
					</label> --}}
				</div>
				<div class="col-md-4">
					{{--<a href="{{ url('asistirCoti') }}"><button class="btn btn-warning pull-right"><i class="fa fa-ambulance"></i> Asistir cotización</button></a>--}}
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-md-12 table-responsive">
					<table class="table">
						<thead>
							<tr>
								<th>#</th>
								<th>
									ASUNTO
								</th>
								<th>
									CLIENTE
								</th>
								<th>
									FECHA / HORA
								</th>
								<th>
									CREADO POR
								</th>
								<th>
									ESTADO
								</th>
								<th width="10%">
									TOTAL
								</th>
								<th colspan="4">
									<center>ACCIONES</center>
								</th>
							</tr>
						</thead>
						<tbody>
							@foreach($cotizaciones as $coti)
								@if($coti->estaCotiEsta == 1)
									<tr class="success">
								@elseif($coti->estaCotiEsta == 10)
									<tr class="active">
								@elseif($coti->estaCotiEsta == 20)
									<tr class="info">
								@elseif($coti->estaCotiEsta == 30)
									<tr class="danger">
								@else
								@endif

								<td style="background-color: #0d6aad; color: #FDFDFD; text-align: center;">
									{{ $coti->numCoti }}
								</td>
								<td>
									{!! $coti->asuntoCoti !!}
								</td>
								{{--@if( $coti->codiClienNatu != '001' )--}}
									{{--<td>{{ $coti->apePaterClienN }} {{ $coti->apeMaterClienN }} {{ $coti->nombreClienNatu }}--}}
									{{--</td>--}}
								{{--@else--}}
									{{--<td>{{ $coti->razonSocialClienJ }}</td>--}}
								{{--@endif--}}
								<td>
									{{ $coti->nomCli }}
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
									S/. {{ $coti->totalVentaSoles }}
								</td>
								<td>
									<a href="{{ url('cotizacion',['codiCoti'=>$coti->codiCoti]) }}" class="btn btn-default btn-xs"><i class="fa fa-eye"></i> ver Costeo </a>
								</td>
								<td>
									<a href="{{ url('pdfCoti',['codiCoti'=>$coti->codiCoti]) }}" target="_blank" class="btn btn-primary btn-xs"><i class="fa fa-eye"></i> ver Cotización </a>
								</td>
								<td style="text-align: center">
									@if( $coti->estaCotiEsta == 1 || $coti->estaCotiEsta == 30)
										<a href="#modal-reutilizar{{$coti->codiCoti}}"
										   data-target="#modal-reutilizar{{$coti->codiCoti}}" data-toggle="modal">
											<button id="btn_reutilizar" type="button" class="btn btn-success btn-xs"><i
														class="fa fa-history"></i> Reutilizar
											</button>
										</a>

										<form action="{{ url('/cotizaciones/reutilizar') }}" method="POST">
											{{Form::token()}}
											<input name="txt_codiCoti" type="hidden" value="{{$coti->codiCoti}}">
											<div class="modal fade modal-slide-in-right" aria-hidden="true"
												 role="dialog" tabindex="-1" id="modal-reutilizar{{$coti->codiCoti}}">

												<div class="modal-dialog">
													<div class="modal-content">
														<div class="modal-header">
															<button class="close" data-dismiss="modal"
																	aria-label="Close">
																<span aria-hidden="true">x</span>
															</button>
															<h4 class="modal-title">Reutilizar
																Cotización {{$coti->numCoti}}</h4>
															<input type="hidden" name="txt_codiCola"
																   value="{{ Auth::user()->codiCola }}">
														</div>
														<div class="modal-body">
															<center>Al reutilizar iniciará una nueva cotización con
																los datos cargados de la cotización seleccionada, el
																temporizador comenzará a correr.
															</center>
														</div>
														<div class="modal-footer">
															<button type="button" class="btn btn-danger"
																	data-dismiss="modal">Cerrar
															</button>
															<button type="submit" class="btn btn-success">
																Continuar
															</button>
														</div>
													</div>
												</div>
											</div>
										</form>
									@elseif ($coti->estaCotiEsta == 20)
										<a href="{{ URL::action('CotizacionController@continuar',$coti->codiCoti) }}">
											<button class="btn btn-info btn-xs"><i class="fa fa-forward"></i> Continuar</button>
										</a>
									@endif
								</td>
								<td>
									@if($coti->estaCotiEsta == 1)
										{{--<a href="{{ url('cerrarCoti', $coti->codiCoti) }}">--}}
										<a href="{{ action('CotizacionFinalController@create', ['id' => $coti->codiCoti]) }}">
											{{--CierreController@cerrarCoti--}}
											<button id="btn_reutilizar" type="button" class="btn btn-danger btn-xs"><i
														class="fa fa-money"></i> Cerrar venta
											</button>
										</a>
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
								<input id="year" name="txt_find_year" class="styled" type="checkbox">
								<label class="control-label" for="year">
									Año
								</label>
							</div>
						</div>
						<div class="col-md-8">
							{{--<input type="text"   class="form-control">--}}
							<input type="number" name="txt_find_year" id="txt_find_year" min="1900" max="2099" step="1" value="{{ date('Y') }}" class="form-control" disabled/>
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
								<input id="colaborador" name="colaborador" class="styled" type="checkbox">
								<label class="control-label" for="colaborador">
									Colaborador
								</label>
							</div>
						</div>
						<div class="col-md-8">
							<select name="cb_colaborador" id="cb_colaborador" class="form-control" disabled>
								<option value="0">Seleccionar colaborador</option>
								@foreach($usuarios as $usuario)
									<option value="{{$usuario->codiCola}}">{{$usuario->name}}</option>
								@endforeach
							</select>
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-md-4">
							<div class="checkbox checkbox-success">
								<input id="asunto" name="asunto" class="styled" type="checkbox">
								<label class="control-label" for="asunto">
									Asunto
								</label>
							</div>						
						</div>
						<div class="col-md-8">
							<input type="text" name="txt_asunto" id="txt_asunto" disabled class="form-control">
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
							<input type="" name="txt_cliente" id="txt_cliente" disabled class="form-control">
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
								Desde<input type="date" id="txtFechaInicio" name="txtFechaInicio" disabled class="form-control">
						  		Hasta<input type="date" id="txtFechaFinal" name="txtFechaFinal" disabled class="form-control">
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

    $("#year").on( 'change', function() {
        if( $(this).is(':checked') ) {
            // Hacer algo si el checkbox ha sido seleccionado
            $('#txt_find_year').prop('disabled', false);
        } else {
            // Hacer algo si el checkbox ha sido deseleccionado
            $('#txt_find_year').prop('disabled', true);
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

	$("#producto").on( 'change', function() {
	    if( $(this).is(':checked') ) {
	        // Hacer algo si el checkbox ha sido seleccionado
	        $('#txt_find_producto').prop('disabled', false);
	    } else {
	        // Hacer algo si el checkbox ha sido deseleccionado
	        $('#txt_find_producto').prop('disabled', true);
	    }
	});

    $("#colaborador").on( 'change', function() {
        if( $(this).is(':checked') ) {
            // Hacer algo si el checkbox ha sido seleccionado
            $('#cb_colaborador').prop('disabled', false);
        } else {
            // Hacer algo si el checkbox ha sido deseleccionado
            $('#cb_colaborador').prop('disabled', true);
        }
    });

	$("#asunto").on( 'change', function() {
	    if( $(this).is(':checked') ) {
	        // Hacer algo si el checkbox ha sido seleccionado
	        $('#txt_asunto').prop('disabled', false);
	    } else {
	        // Hacer algo si el checkbox ha sido deseleccionado
	        $('#txt_asunto').prop('disabled', true);
	    }
	});

	$("#cliente").on( 'change', function() {
	    if( $(this).is(':checked') ) {
	        // Hacer algo si el checkbox ha sido seleccionado
	        $('#txt_cliente').prop('disabled', false);
	    } else {
	        // Hacer algo si el checkbox ha sido deseleccionado
	        $('#txt_cliente').prop('disabled', true);
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