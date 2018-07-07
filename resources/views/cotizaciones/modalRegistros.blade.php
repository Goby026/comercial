<!-- Modal para agregar nuevo cliente -->
<div id="addModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<h4 class="modal-title"></h4>
			</div>
			<div class="modal-body">
				<div class="tabbable" id="tabs-51352">
					<ul class="nav nav-tabs">
						@foreach($tipoClientes as $tipo)
						<li class="nav-item">
							<a class="nav-link" href="#panel-{{$tipo->codiTipoCliente}}" data-toggle="tab">{{$tipo->nombreTipoCliente}}</a>
						</li>
						@endforeach
					</ul>
					<div class="tab-content">
						@foreach($tipoClientes as $tipo)
						<div class="tab-pane" id="panel-{{$tipo->codiTipoCliente}}">
							@if($tipo->codiTipoCliente == 'TC_3_5_201869111138534101227')							
							<div class="form-group">
								<label for="">Nombres</label>
								<input type="text" name="txt_nombreClienNatu" class="form-control" placeholder="nombre..." value="{{old('txt_nombreClienNatu')}}">
							</div>
							<div class="form-group">
								<label for="">Apellido Paterno</label>
								<input type="text" name="txt_apePaterClienN" class="form-control" placeholder="apellido paterno..." value="{{old('txt_apePaterClienN')}}">
							</div>
							<div class="form-group">
								<label for="">Apellido Materno</label>
								<input type="text" name="txt_apeMaterClienN" class="form-control" placeholder="apellido materno..." value="{{old('txt_apeMaterClienN')}}">
							</div>
							<div class="form-group">
								<label for="">Dni</label>
								<input type="text" name="txt_dniClienNatu" class="form-control" placeholder="dni..." value="{{old('txt_dniClienNatu')}}">
							</div>
							<div class="form-group">
								<label for="">Dirección</label>
								<input type="text" name="txt_direcClienNatu" class="form-control" placeholder="dirección..." value="{{old('txt_direcClienNatu')}}">
							</div>
							<div class="form-group">
								<label for="">Distrito</label>
								<input type="text" name="txt_codiDistri" class="form-control" placeholder="distrito..." value="{{old('txt_codiDistri')}}">
							</div>
							<div class="form-group">
								<label for="">Provincia</label>
								<input type="text" name="txt_codiProvin" class="form-control" placeholder="provincia..." value="{{old('txt_codiProvin')}}">
							</div>
							<div class="form-group">
								<label for="">Departamento</label>
								<input type="text" name="txt_codiDepar" class="form-control" placeholder="departamento..." value="{{old('txt_codiDepar')}}">
							</div>
							<div class="form-group">
								<label for="">Fecha de Nacimiento</label>
								<input type="date" name="txt_fechaNaciClienN" class="form-control" placeholder="fecha de nacimiento..." value="{{old('txt_fechaNaciClienN')}}">
							</div>
							<div class="form-group">
								<label for="">Email</label>
								<input type="email" name="txt_correoClienNatu" class="form-control" placeholder="email..." value="{{old('txt_correoClienNatu')}}">
							</div>
							<div class="form-group">
								<label for="">Teléfono 01</label>
								<input type="text" name="txt_tele01ClienNatu" class="form-control" placeholder="telefono 01..." value="{{old('txt_tele01ClienNatu')}}">
							</div>
							<div class="form-group">
								<label for="">Teléfono 02</label>
								<input type="text" name="txt_tele02ClienNatu" class="form-control" placeholder="telefono 02..." value="{{old('txt_tele02ClienNatu')}}">
							</div>
							@else
							<div class="form-group">
								<label for="">Razon Social</label>
								<input type="text" id="txt_razonSocial" name="txt_razonSocial" class="form-control" placeholder="Razon social..." value="{{old('txt_razonSocial')}}">
							</div>
							<div class="form-group">
								<label for="">Ruc</label>
								<input type="text" name="txt_ruc" class="form-control" placeholder="Ruc..." value="{{old('txt_ruc')}}">
							</div>
							<div class="form-group">
								<label for="">Dirección</label>
								<input type="text" name="txt_direccion" class="form-control" placeholder="Dirección..." value="{{old('txt_direccion')}}">
							</div>
							<div class="form-group">
								<label for="">Distrito</label>
								<input type="text" name="txt_codiDistri" class="form-control" placeholder="Distrito..." value="{{old('txt_codiDistri')}}">
							</div>
							<div class="form-group">
								<label for="">Provincia</label>
								<input type="text" name="txt_codiProvin" class="form-control" placeholder="Provincia..." value="{{old('txt_codiProvin')}}">
							</div>
							<div class="form-group">
								<label for="">Departamento</label>
								<input type="text" name="txt_codiDepar" class="form-control" placeholder="Departamento..." value="{{old('txt_codiDepar')}}">
							</div>
							<div class="form-group">
								<label for="">Tipo Cliente</label>
								<select name="idTipocli" class="form-control">
									@foreach($tipoClientesJuridicos as $tipos)
									<option value="{{$tipos->codiTipoCliJur}}">{{$tipos->descTipoCliJur}}</option>
									@endforeach
								</select>
							</div>
							<div class="form-group">
								<label for="">Web</label>
								<input type="text" name="txt_web" class="form-control" placeholder="Web..." value="{{old('txt_web')}}">
							</div>
							@endif
						</div>
						@endforeach
					</div>
				</div>
				<div class="modal-footer">					
					<button type="button" class="btn btn-success add" data-dismiss="modal">
						<span id="" class='fa fa-check'></span> Registrar
					</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal">
						<span class='fa fa-remove'></span> Cerrar
					</button>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Modal para agregar nuevo contacto -->
<div id="addModal-contact" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<h4 class="modal-title"></h4>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<label for="">Nombres</label>
					<input type="text" name="txt_nombreContacClien" class="form-control" placeholder="nombre..." value="{{old('txt_nombreContacClien')}}">
				</div>
				<div class="form-group">
					<label for="">Apellido Paterno</label>
					<input type="text" name="txt_apePaterContacC" class="form-control" placeholder="apellido paterno..." value="{{old('txt_apePaterContacC')}}">
				</div>
				<div class="form-group">
					<label for="">Apellido Materno</label>
					<input type="text" name="txt_apeMaterContacC" class="form-control" placeholder="apellido materno..." value="{{old('txt_apeMaterContacC')}}">
				</div>
				<div class="form-group">
					<label for="">Email</label>
					<input type="email" name="txt_correoContacClien" class="form-control" placeholder="email..." value="{{old('txt_correoContacClien')}}">
				</div>
				<div class="form-group">
					<label for="">Dirección</label>
					<input type="text" name="txt_direcContacClien" class="form-control" placeholder="dirección..." value="{{old('txt_direcContacClien')}}">
				</div>
				<div class="form-group">
					<label for="">Distrito</label>
					<input type="text" name="txt_codiDistric" class="form-control" placeholder="distrito..." value="{{old('txt_codiDistric')}}">
				</div>
				<div class="form-group">
					<label for="">Provincia</label>
					<input type="text" name="txt_codiProvinc" class="form-control" placeholder="provincia..." value="{{old('txt_codiProvinc')}}">
				</div>
				<div class="form-group">
					<label for="">Departamento</label>
					<input type="text" name="txt_codiDeparc" class="form-control" placeholder="departamento..." value="{{old('txt_codiDeparc')}}">
				</div>
				<div class="form-group">
					<label for="">Celular 01</label>
					<input type="text" name="txt_celu01ContacClien" class="form-control" placeholder="celular 01..." value="{{old('txt_celu01ContacClien')}}">
				</div>
				<div class="form-group">
					<label for="">Celular 02</label>
					<input type="text" name="txt_celu02ContacClien" class="form-control" placeholder="celular 02..." value="{{old('txt_celu02ContacClien')}}">
				</div>
				<div class="form-group">
					<label for="">Teléfono</label>
					<input type="text" name="txt_teleContacClien" class="form-control" placeholder="teléfono..." value="{{old('txt_teleContacClien')}}">
				</div>
				<div class="form-group">
					<label for="">Anexo</label>
					<input type="text" name="txt_aneContacClien" class="form-control" placeholder="anexo..." value="{{old('txt_aneContacClien')}}">
				</div>
				<div class="form-group">
					<label for="">Cliente</label>
					<input type="text" name="txt_codiClienJuri" class="form-control" placeholder="cliente..." value="{{old('txt_codiClienJuri')}}">
				</div>
				<div class="modal-footer-contac">
					<button type="button" class="btn btn-success add-contac" data-dismiss="modal">
						<span id="" class='fa fa-check'></span> Registrar
					</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal">
						<span class='fa fa-remove'></span> Cerrar
					</button>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Modal para confirmar nuevo item -->
<div id="addModal-newItem" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<h4 class="modal-title"></h4>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<label for="">¿Desea agregar otro item?</label>
				</div>
				<div class="modal-footer-newItem">
					<a href="#" class="btn btn-success add-newItem" data-dismiss="modal">
						<span id="" class='fa fa-check'></span> Continuar
					</a>
					<button type="button" class="btn btn-danger" data-dismiss="modal">
						<span class='fa fa-remove'></span> Cerrar
					</button>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
		// agregar nuevo cliente
		$(document).on('click', '.add-modal', function() {
			$('.modal-title').text('Nuevo cliente');
			$('#addModal').modal('show');
		});

		// agregar nuevo contacto
		$(document).on('click', '.add-modal-contact', function() {
			$('.modal-title').text('Nuevo Contacto');
			$('#addModal-contact').modal('show');
		});

		// registrar nuevo item
		$(document).on('click', '.add-modal-newItem', function() {
			$('.modal-title').text('Confirmar nuevo item');
			$('#addModal-newItem').modal('show');
		});

		$('.modal-footer').on('click', '.add', function() {
			if ($('#txt_razonSocial').val() != "") {
				datos = {
					'_token':$('input[name=_token]').val(),
					txt_razonSocial : $('input[name=txt_razonSocial]').val(),
					txt_ruc : $('input[name=txt_ruc]').val(),
					txt_direccion :$('input[name=txt_direccion]').val(),
					txt_codiDistri :$('input[name=txt_codiDistri]').val(),
					txt_codiProvin :$('input[name=txt_codiProvin]').val(),
					txt_codiDepar :$('input[name=txt_codiDepar]').val(),
					idTipocli :$('input[name=idTipocli]').val(),
					txt_web :$('input[name=txt_web]').val(),
					txt_codiCola : $('input[name=txt_codiCola]').val(),
					txt_codiTipoCliente : 'tc001'
				};
				limpiarCampos(2);
			}else{
				datos = {
					'_token':$('input[name=_token]').val(),
					txt_nombreClienNatu : $('input[name=txt_nombreClienNatu]').val(),
					txt_apePaterClienN : $('input[name=txt_apePaterClienN]').val(),
					txt_apeMaterClienN :$('input[name=txt_apeMaterClienN]').val(),
					txt_dniClienNatu :$('input[name=txt_dniClienNatu]').val(),
					txt_direcClienNatu :$('input[name=txt_direcClienNatu]').val(),
					txt_codiDistri :$('input[name=txt_codiDistri]').val(),
					txt_codiProvin :$('input[name=txt_codiProvin]').val(),
					txt_codiDepar :$('input[name=txt_codiDepar]').val(),
					txt_fechaNaciClienN :$('input[name=txt_fechaNaciClienN]').val(),
					txt_correoClienNatu :$('input[name=txt_correoClienNatu]').val(),
					txt_tele01ClienNatu :$('input[name=txt_tele01ClienNatu]').val(),
					txt_tele02ClienNatu :$('input[name=txt_tele02ClienNatu]').val(),
					txt_codiCola : $('input[name=txt_codiCola]').val(),
					txt_codiTipoCliente : 'TC_3_5_201869111138534101227'
				};
				limpiarCampos(1);
			}

			$.ajax({
				type: 'POST',
				url: "{{ URL::to('/addCli') }}",
				data: datos,
				success: function(response) {
						console.log(response);
					}
				});
			
		});

		$('.modal-footer-contac').on('click', '.add-contac', function() {
			//registrar contacto
			datos = {
					'_token':$('input[name=_token]').val(),
					txt_apePaterContacC : $('input[name=txt_apePaterContacC]').val(),
					txt_apeMaterContacC : $('input[name=txt_apeMaterContacC]').val(),
					txt_nombreContacClien :$('input[name=txt_nombreContacClien]').val(),
					txt_correoContacClien :$('input[name=txt_correoContacClien]').val(),
					txt_direcContacClien :$('input[name=txt_direcContacClien]').val(),
					txt_codiDistri :$('input[name=txt_codiDistric]').val(),
					txt_codiProvin :$('input[name=txt_codiProvinc]').val(),
					txt_codiDepar :$('input[name=txt_codiDeparc]').val(),
					txt_celu01ContacClien :$('input[name=txt_celu01ContacClien]').val(),
					txt_celu02ContacClien :$('input[name=txt_celu02ContacClien]').val(),
					txt_teleContacClien :$('input[name=txt_teleContacClien]').val(),
					txt_aneContacClien :$('input[name=txt_aneContacClien]').val(),
					txt_codiClienJuri : $('input[name=txt_codiClienJuri]').val(),
					txt_codiCola : $('input[name=txt_codiCola]').val(),
					txt_opcion : 'DESDE_COTIZACIONES'
				};
				limpiarCampos(3);
				$.ajax({
					type: 'POST',
					url: "{{ URL::to('contactosCliente') }}",
					data: datos,
					success: function(response) {
							console.log(response);
						}
					});			
		});

		$('.modal-footer-newItem').on('click', '.add-newItem', function() {
			//registrar nuevo itemCosteo
			datos = {				
					'_token':$('input[name=_token]').val(),
					codiCoti : $('input[name=txtNumCoti]').val()
				};
				$.ajax({
					type: 'POST',
					url: "{{ URL::to('addItem') }}",
					data: datos,
					success: function(response) {
							console.log(response);

							if (response == '1') {
								location.reload();
							}else{
								console.log("error");
							}
						}
					});
		});

		function limpiarCampos(tipoCliente){
			if (tipoCliente == 1) {//natural
				$('input[name=txt_nombreClienNatu]').val("");
				$('input[name=txt_apePaterClienN]').val("");
				$('input[name=txt_apeMaterClienN]').val("");
				$('input[name=txt_dniClienNatu]').val("");
				$('input[name=txt_direcClienNatu]').val("");
				$('input[name=txt_codiDistri]').val("");
				$('input[name=txt_codiProvin]').val("");
				$('input[name=txt_codiDepar]').val("");
				$('input[name=txt_fechaNaciClienN]').val("");
				$('input[name=txt_correoClienNatu]').val("");
				$('input[name=txt_tele01ClienNatu]').val("");
				$('input[name=txt_tele02ClienNatu]').val("");
			}else if (tipoCliente == 2){//juridico
				$('input[name=txt_razonSocial]').val("");
				$('input[name=txt_ruc]').val("");
				$('input[name=txt_direccion]').val("");
				$('input[name=txt_codiDistri]').val("");
				$('input[name=txt_codiProvin]').val("");
				$('input[name=txt_codiDepar]').val("");
				$('input[name=idTipocli]').val("");
				$('input[name=txt_web]').val("");
			}else{
				$('input[name=txt_apePaterContacC]').val("");
				$('input[name=txt_apeMaterContacC]').val("");
				$('input[name=txt_nombreContacClien]').val("");
				$('input[name=txt_correoContacClien]').val("");
				$('input[name=txt_direcContacClien]').val("");
				$('input[name=txt_codiDistric]').val("");
				$('input[name=txt_codiProvinc]').val("");
				$('input[name=txt_codiDeparc]').val("");
				$('input[name=txt_celu01ContacClien]').val("");
				$('input[name=txt_celu02ContacClien]').val("");
				$('input[name=txt_teleContacClien]').val("");
				$('input[name=txt_aneContacClien]').val("");
				$('input[name=txt_codiClienJuri]').val("");
				$('input[name=txt_codiCola]').val("");
			}
		}
	</script>