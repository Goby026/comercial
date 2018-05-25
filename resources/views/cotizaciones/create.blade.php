@extends ('layouts.admin')
@section ('contenido')
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
				
			</div>
		</div>

		{!!Form::model($cotizacion,['method'=>'PATCH','route'=>['cotizaciones.update',$cotizacion]])!!}
		{{Form::token()}}

		<div class="row">
			<div class="col-md-12">
				<div class="row">
					<div class="col-md-10">
						<div class="form-group">
							Asunto:<input type="text" id="txt_asuntoCoti" name="txt_asuntoCoti" class="form-control" value="{{ old('txt_asuntoCoti') }}">							
						</div>
					<input type="hidden" name="txt_codiCola" value="{{ Auth::user()->name }}">
					</div>
					<div class="col-md-2">
						Atención:
						@if(isset($cotizacion))
						<input type="text" id="txt_atencion" name="txt_atencion" class="form-control" value="{{ $cotizacion }}">
						@else
						<input type="text" id="txt_atencion" name="txt_atencion" class="form-control" value="{{ old('txt_atencion') }}">
						@endif
					</div>
				</div>
				<div class="row">
					<div class="col-md-10">
						<div class="form-group">
							Cliente:
							<select id="txt_cliente" name="txt_cliente" class="form-control selectpicker" data-live-search="true">
								@foreach($clientes as $cliente)
								<option value="{{ $cliente->codiClienJuri }}">{{ $cliente->razonSocialClienJ }}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="col-md-2">
						<br>						
						<a href="#" class="btn btn-success add-modal" style="width: 100%;">Nuevo Cliente</a>
					</div>
				</div>
			</div>
		</div>
		
		<br>
		<div class="row">
			<div class="col-md-12">
				<div class="row">
					<div class="col-md-10">
					</div>
					<div class="col-md-2">
						<button id="btn_add_prod" type="button" class="btn btn-info pull-right" onclick="AgregarCampos()" style="width: 100%;">Agregar Producto</button>
						<a href=""></a>
					</div>
				</div><br>
				<div class="panel panel-primary">
					<div class="panel-body">
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									Producto
									<input type="text" id="txt_producto" name="txt_producto" class="form-control">
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									Descripción
									<textarea class="form-control" name="txt_descripion"></textarea>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									Cantidad
									<input type="number" id="txt_cantidad" name="txt_cantidad" class="form-control">
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									C. U. $ SIN
									<input type="number" id="txt_cus_dolar_sin" name="txt_cus_dolar_sin" class="form-control">
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									C. U. $
									<input type="number" id="txt_cus_dolar" name="txt_cus_dolar" class="form-control">
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									TOTAL
									<input type="number" id="txt_total_dolar" name="txt_total_dolar" class="form-control">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-3">									
							</div>
							<div class="col-md-3">
							</div>
							<div class="col-md-3">
								<div class="form-group">
									C. U. S/.
									<input type="number" id="txt_cus_soles" name="txt_cus_soles" class="form-control">
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									TOTAL
									<input type="number" id="txt_total_soles" name="txt_total_soles" class="form-control">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-3">
							</div>
							<div class="col-md-3">
							</div>
							<div class="col-md-3">
								<div class="form-group">
									MARGEN C.U. S/.
									<input type="number" id="txt_margen_cu_soles" name="txt_margen_cu_soles" class="form-control">
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									P. U. S/.
									<input type="number" id="txt_pu_soles" name="txt_pu_soles" class="form-control">
								</div>
							</div>
						</div>
						<div class="form-group">
							<a href=""><button id="btn_guardar" type="button" class="btn btn-info pull-right">Guardar</button></a>
							<a href=""><button id="btn_eliminar" type="button" class="btn btn-danger pull-right">Eliminar</button></a>
						</div>
					</div>
				</div>
				<!-- div para las nuevas cotizaciones -->
				<div id="campos"></div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-3">
			</div>
			<div class="col-md-2">
				<div class="form-group">
					<label>TOTAL</label>
					<input type="text" name="txt_cantiCoti" class="form-control">
				</div>
			</div>
			<div class="col-md-2">
				<div class="form-group">
					<label>UTILIDAD</label>
					<input type="text" name="txt_cantiCoti" class="form-control">
				</div>
			</div>
			<div class="col-md-2">
				<div class="form-group">
					<label>MARGEN</label>
					<input type="text" name="txt_cantiCoti" class="form-control">
				</div>
			</div>
			<div class="col-md-3">
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
			</div>
			<div class="col-md-4">
			</div>
			<div class="col-md-2">
			</div>
			<div class="col-md-2">
				<button class="btn btn-warning pull-right" style="width: 100%;">GUARDAR PRE-COTIZACION</button>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-md-6">
				
			</div>
			<div class="col-md-2">
				<button class="btn btn-default pull-right" style="width: 100%;">VER CARTA DE PRESENTACION</button>
			</div>
			<div class="col-md-2">
				<button class="btn btn-default pull-right" style="width: 100%;">VER COTIZACION</button>
			</div>
			<div class="col-md-2">
				<button class="btn btn-success pull-right" type="submit" style="width: 100%;">GUARDAR COTIZACION</button>
			</div>
		</div>

		{!!Form::close()!!}
		
	</div>

	<!-- Modal para agregar nuevo cliente -->
    <div id="addModal" class="modal fade" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">×</button>
						<h4 class="modal-title"></h4>
					</div>
					<div class="modal-body">
						<form class="form-horizontal" role="form">
							<div class="form-group">
								<label class="control-label col-sm-2" for="idTipocli">Tipo</label>
								<div class="col-sm-10">
									<select name="idTipocli" id="idTipocli" class="form-control">
										@foreach($tipoClientes as $tipos)
										<option value="{{$tipos->codiTipoCliente}}">{{$tipos->nombreTipoCliente}}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-2" for="title">Cliente:</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="title_add" autofocus>
									<small>Min: 2, Max: 32, solo texto</small>
									<p class="errorTitle text-center alert alert-danger hidden"></p>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-2" for="title">Documento:</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="title_add" autofocus>
									<small>Min: 2, Max: 32, solo texto</small>
									<p class="errorTitle text-center alert alert-danger hidden"></p>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-2" for="content">Content:</label>
								<div class="col-sm-10">
									<textarea class="form-control" id="content_add" cols="40" rows="5"></textarea>
									<small>Min: 2, Max: 128, solo texto</small>
									<p class="errorContent text-center alert alert-danger hidden"></p>
								</div>
							</div>
						</form>
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

	<script>
		var editor_config = {
			selector:'textarea',
			height:200,
			theme: 'modern',
			menubar: false,
			plugins: ['print preview wordcount emoticons']
		}

		tinymce.init(editor_config);
	</script>

	<script>
		// agregar nuevo cliente
		$(document).on('click', '.add-modal', function() {
			$('.modal-title').text('Nuevo cliente');
			$('#addModal').modal('show');
		});

		$('.modal-footer').on('click', '.add', function() {
			var codigo = $('input[name=txt_atencion]').val();
			var tipoCliente = $('#idTipocli').val();
			$.ajax({
				type: 'POST',
				url: "{{ URL::to('/addCli') }}",
				data: {
					'_token':$('input[name=_token]').val(),
					'tipo':tipoCliente,
					'var': 'ASD',
					'codi': codigo
				},
				success: function(data) {
					console.log(data)
				}
			});
		});
	</script>

	@push ('scripts')
	
	<script type="text/javascript">
		var nextinput = 0;
		function AgregarCampos(){
			nextinput++;
			// campo = '<li id="rut'+nextinput+'"><input type="text" size="20" id="campo' + nextinput + '"&nbsp; name="campo' + nextinput + '"&nbsp; class="form-control"/></li>';

			campo = '<div class="panel panel-primary">';
			campo += '<div class="panel-body">';
			campo += '<div class="row">';
			campo += '<div class="col-md-12">';
			campo += '<div class="form-group">Producto';
			campo += '<input type="text" name="txt_cantiCoti" class="form-control">';
			campo += '</div>';
			campo += '</div>';
			campo += '</div>';
			campo += '<div class="row">';
			campo += '<div class="col-md-3">';
			campo += '<div class="form-group">Cantidad';

			campo += '<input type="number" name="txt_cantiCoti" class="form-control">';
			campo += '</div>';
			campo += '</div>';
			campo += '<div class="col-md-3">';
			campo += '<div class="form-group">C. U. $ SIN';
									
			campo += '<input type="number" name="txt_cantiCoti" class="form-control">';
			campo += '</div>';
			campo += '</div>';
			campo += '<div class="col-md-3">';
			campo += '<div class="form-group">C. U. $';

			campo += '<input type="number" name="txt_cantiCoti" class="form-control">';
			campo += '</div>';
			campo += '</div>';
			campo += '<div class="col-md-3">';
			campo += '<div class="form-group">TOTAL';									
			campo += '<input type="number" name="txt_cantiCoti" class="form-control">';
			campo += '</div>';
			campo += '</div>';
			campo += '</div>';
			campo += '<div class="row">';
			campo += '<div class="col-md-3">';
			campo += '</div>';
			campo += '<div class="col-md-3">';
			campo += '</div>';
			campo += '<div class="col-md-3">';
			campo += '<div class="form-group">C. U. S/.';

			campo += '<input type="number" name="txt_cantiCoti" class="form-control">';
			campo += '</div>';
			campo += '</div>';
			campo += '<div class="col-md-3">';
			campo += '<div class="form-group">TOTAL';

			campo += '<input type="number" name="txt_cantiCoti" class="form-control">';
			campo += '</div>';
			campo += '</div>';
			campo += '</div>';
			campo += '<div class="row">';
			campo += '<div class="col-md-3">';
			campo += '</div>';
			campo += '<div class="col-md-3">';
			campo += '</div>';
			campo += '<div class="col-md-3">';
			campo += '<div class="form-group">MARGEN C.U. S/.';

			campo += '<input type="number" name="txt_cantiCoti" class="form-control">';
			campo += '</div>';
			campo += '</div>';
			campo += '<div class="col-md-3">';
			campo += '<div class="form-group">P. U. S/.';

			campo += '<input type="number" name="txt_cantiCoti" class="form-control">';
			campo += '</div>';
			campo += '</div>';
			campo += '</div>';
			campo += '<div class="form-group">';
			campo += '<a href=""><button class="btn btn-info pull-right">Guardar</button></a>';
			campo += '<a href=""><button class="btn btn-danger pull-right">Eliminar</button></a>';
			campo += '</div>';
			campo += '</div>';
			campo += '</div>';

			$("#campos").append(campo);
		}

		window.addEventListener('load', deshabilitar, false);

		function deshabilitar(){
			// $("#txt_asunto").attr('disabled','disabled');
			// $("#txt_atencion").attr('disabled','disabled');
			// $("#txt_cliente").attr('disabled','disabled');
			
			// $("#btn_nuevo_cliente").attr('disabled','disabled');
			// $("#btn_add_prod").attr('disabled','disabled');

			// $("#txt_producto").attr('disabled','disabled');
			// $("#txt_cantidad").attr('disabled','disabled');

			// $("#txt_cus_dolar_sin").attr('disabled','disabled');
			// $("#txt_cus_dolar").attr('disabled','disabled');
			// $("#txt_total_dolar").attr('disabled','disabled');

			// $("#txt_cus_soles").attr('disabled','disabled');
			// $("#txt_total_soles").attr('disabled','disabled');
			// $("#txt_margen_cu_soles").attr('disabled','disabled');
			// $("#txt_pu_soles").attr('disabled','disabled');
			
			// $("#btn_guardar").attr('disabled','disabled');
			// $("#btn_eliminar").attr('disabled','disabled');
		}

		function habilitar(){
			$("#btn_iniciar_cotizacion").attr('disabled','disabled');
			$("#txt_asunto").removeAttr('disabled');
			$("#txt_atencion").removeAttr('disabled');
			$("#txt_cliente").removeAttr('disabled');
			
			$("#btn_nuevo_cliente").removeAttr('disabled');
			$("#btn_add_prod").removeAttr('disabled');

			$("#txt_producto").removeAttr('disabled');
			$("#txt_cantidad").removeAttr('disabled');

			$("#txt_cus_dolar_sin").removeAttr('disabled');
			$("#txt_cus_dolar").removeAttr('disabled');
			$("#txt_total_dolar").removeAttr('disabled');

			$("#txt_cus_soles").removeAttr('disabled');
			$("#txt_total_soles").removeAttr('disabled');
			$("#txt_margen_cu_soles").removeAttr('disabled');
			$("#txt_pu_soles").removeAttr('disabled');
			
			$("#btn_guardar").removeAttr('disabled');
			$("#btn_eliminar").removeAttr('disabled');
			
		}
	</script>
	@endpush
@endsection