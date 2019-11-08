<?php $__env->startSection('contenido'); ?>
<style type="text/css">
	input[type=checkbox] {
		cursor: pointer;
	}

	thead{
		background-color: #9f191f;
		color: #FDFDFD;
	}

	p{
		background-color: #2c3b41;
	}

</style>
<div class="container-fluid">

	<div class="row">
		<div class="col-md-12">
			<div id="newcoti">
				<new-cotizacion></new-cotizacion>
			</div>
<?php /*			<div class="page-header">*/ ?>
<?php /*				<h1>*/ ?>
<?php /*					COTIZACIONES <small>Panel principal</small><a href="" data-target="#modal-inicio" data-toggle="modal"><button id="btn_iniciar_cotizacion" type="button" class="btn btn-primary pull-right"><i class="fa fa-plus-square"></i> Nueva cotización</button></a>*/ ?>
<?php /*				</h1>*/ ?>
<?php /*			</div>*/ ?>
<?php /*			<?php echo $__env->make('cotizaciones.modal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>*/ ?>
			
			<div class="row">
				<div class="col-md-10">
					<?php /* <label>
						<button type="button" class="btn btn-default">Ver cotizaciones asistidas</button>
					</label> */ ?>
					<div class="input-group">
						<input type="text" class="form-control" placeholder="Producto - # cotizacion - cliente">
						<span class="input-group-btn">
							<button class="btn btn-default" type="button">Buscar!</button>
						  </span>
					</div>
				</div>
				<div class="col-md-2">
					<?php /*<a href="<?php echo e(url('asistirCoti')); ?>"><button class="btn btn-warning pull-right"><i class="fa fa-ambulance"></i> Asistir cotización</button></a>*/ ?>
                    <a href="#" id="btn_busqueda" class="btn btn-warning search-modal pull-right"><i class="fa fa-search"></i></a>
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
							<?php foreach($cotizaciones as $coti): ?>
								<?php if($coti->estaCotiEsta == 1): ?>
									<tr class="success">
								<?php elseif($coti->estaCotiEsta == 10): ?>
									<tr class="active">
								<?php elseif($coti->estaCotiEsta == 20): ?>
									<tr class="info">
								<?php elseif($coti->estaCotiEsta == 30): ?>
									<tr class="danger">
								<?php else: ?>
								<?php endif; ?>

								<td style="background-color: #0d6aad; color: #FDFDFD; text-align: center;">
									<?php echo e($coti->numCoti); ?>

								</td>
								<td>
									<?php echo $coti->asuntoCoti; ?>

								</td>
								<?php /*<?php if( $coti->codiClienNatu != '001' ): ?>*/ ?>
									<?php /*<td><?php echo e($coti->apePaterClienN); ?> <?php echo e($coti->apeMaterClienN); ?> <?php echo e($coti->nombreClienNatu); ?>*/ ?>
									<?php /*</td>*/ ?>
								<?php /*<?php else: ?>*/ ?>
									<?php /*<td><?php echo e($coti->razonSocialClienJ); ?></td>*/ ?>
								<?php /*<?php endif; ?>*/ ?>
								<td>
									<?php echo e($coti->nomCli); ?>

								</td>
								<td>
									<?php echo e($coti->fechaSistema); ?>

								</td>
								<td>
									<?php echo e($coti->nombreCola); ?> <?php echo e($coti->apePaterCola); ?> <?php echo e($coti->apeMaterCola); ?>

								</td>
								<td>
									<?php echo e($coti->nombreCotiEsta); ?>

								</td>
								<td>
									S/. <?php echo e($coti->totalVentaSoles); ?>

								</td>
								<td>
									<a href="<?php echo e(url('cotizacion',['codiCoti'=>$coti->codiCoti])); ?>" class="btn btn-default btn-xs"><i class="fa fa-eye"></i> ver Costeo </a>
								</td>
								<td>
<?php /*									<a href="<?php echo e(url('pdfCoti',['codiCoti'=>$coti->codiCoti])); ?>" target="_blank" class="btn btn-primary btn-xs"><i class="fa fa-eye"></i> ver Cotización </a>*/ ?>
									<!-- Single button -->
									<div class="btn-group">
										<button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											Ver Cotización <span class="caret"></span>
										</button>
										<ul class="dropdown-menu">
											<li><a href="<?php echo e(url('pdfCoti',['codiCoti'=>$coti->codiCoti , 0])); ?>" target="_blank">Perú Data</a></li>
											<li><a href="<?php echo e(url('pdfCoti',['codiCoti'=>$coti->codiCoti , 1])); ?>" target="_blank">Proveedora</a></li>
											<li><a href="<?php echo e(url('pdfCoti',['codiCoti'=>$coti->codiCoti , 2])); ?>" target="_blank">Annie</a></li>
										</ul>
									</div>
								</td>
								<td style="text-align: center">
									<?php if( $coti->estaCotiEsta == 1 || $coti->estaCotiEsta == 30): ?>
										<a href="#modal-reutilizar<?php echo e($coti->codiCoti); ?>"
										   data-target="#modal-reutilizar<?php echo e($coti->codiCoti); ?>" data-toggle="modal">
											<button id="btn_reutilizar" type="button" class="btn btn-success btn-xs"><i
														class="fa fa-history"></i> Reutilizar
											</button>
										</a>

										<form action="<?php echo e(url('/cotizaciones/reutilizar')); ?>" method="POST">
											<?php echo e(Form::token()); ?>

											<input name="txt_codiCoti" type="hidden" value="<?php echo e($coti->codiCoti); ?>">
											<div class="modal fade modal-slide-in-right" aria-hidden="true"
												 role="dialog" tabindex="-1" id="modal-reutilizar<?php echo e($coti->codiCoti); ?>">

												<div class="modal-dialog">
													<div class="modal-content">
														<div class="modal-header">
															<button class="close" data-dismiss="modal"
																	aria-label="Close">
																<span aria-hidden="true">x</span>
															</button>
															<h4 class="modal-title">Reutilizar
																Cotización <?php echo e($coti->numCoti); ?></h4>
															<input type="hidden" name="txt_codiCola"
																   value="<?php echo e(Auth::user()->codiCola); ?>">
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
									<?php elseif($coti->estaCotiEsta == 20): ?>
										<a href="<?php echo e(URL::action('CotizacionController@continuar',$coti->codiCoti)); ?>">
											<button class="btn btn-info btn-xs"><i class="fa fa-forward"></i> Continuar</button>
										</a>
									<?php endif; ?>
								</td>
								<td>
									<?php if($coti->estaCotiEsta == 1): ?>
										<?php /*<a href="<?php echo e(url('cerrarCoti', $coti->codiCoti)); ?>">*/ ?>
										<a href="<?php echo e(action('CotizacionFinalController@create', ['id' => $coti->codiCoti])); ?>">
											<?php /*CierreController@cerrarCoti*/ ?>
											<button id="btn_reutilizar" type="button" class="btn btn-danger btn-xs"><i
														class="fa fa-money"></i> Cerrar venta
											</button>
										</a>
									<?php endif; ?>
								</td>
							</tr>
							<?php endforeach; ?>

						</tbody>
					</table>
					<?php echo e($cotizaciones->render()); ?>

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
				<form action="<?php echo e(url('/find_params')); ?>" method="GET">
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
							<?php /*<input type="text"   class="form-control">*/ ?>
							<input type="number" name="txt_find_year" id="txt_find_year" min="1900" max="2099" step="1" value="<?php echo e(date('Y')); ?>" class="form-control" disabled/>
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
								<?php foreach($usuarios as $usuario): ?>
									<option value="<?php echo e($usuario->codiCola); ?>"><?php echo e($usuario->name); ?></option>
								<?php endforeach; ?>
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

<script src="<?php echo e(asset('js/vue-cotizacion/index.js')); ?>"></script>

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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>