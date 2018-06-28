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
				<center>Código Cotización</center>
				@if(isset($coti_continue))
				<input type="text" disabled name="txtNumCoti" class="form-control" value="{{ $coti_continue->codiCoti }}" style="text-align: center;">
				@else
				<input type="text" disabled name="txtNumCoti" class="form-control" value="{{ $cotizacion }}" style="text-align: center;">
				@endif
			</div>
		</div>

		<style type="text/css">
			.panel-produc{
				background-color: #DFFBE6;
			}
		</style>
		
		@if(isset($coti_continue))
		{!!Form::model($coti_continue,['method'=>'PATCH','route'=>['cotizaciones.update',$coti_continue]])!!}
		@else
		{!!Form::model($cotizacion,['method'=>'PATCH','route'=>['cotizaciones.update',$cotizacion]])!!}
		@endif

		{{Form::token()}}

		<div class="row">
			<div class="col-md-12">
				<div class="row">
					<div class="col-md-10">
						<div class="form-group">
							Cliente:
							@if(isset($coti_continue))
							<select id="txt_cliente" name="txt_cliente" class="form-control selectpicker" data-live-search="true">
								@foreach($clientes as $cliente)
								@if( $cliente->codiClienNatu != '001' )
									@if($cliente->codiClienNatu == $_cliente->codiClienNatu)
									<option value="{{$cliente->codiClien}}" selected>{{ $cliente->apePaterClienN }} {{ $cliente->apeMaterClienN }} {{ $cliente->nombreClienNatu }}</option>
									@else
									<option value="{{$cliente->codiClien}}">{{ $cliente->apePaterClienN }} {{ $cliente->apeMaterClienN }} {{ $cliente->nombreClienNatu }}</option>
									@endif
								@else
									@if($cliente->codiClienJuri == $_cliente->codiClienJuri)
									<option value="{{ $cliente->codiClien}}" selected>{{ $cliente->razonSocialClienJ }}</option>
									@else
									<option value="{{ $cliente->codiClien}}">{{ $cliente->razonSocialClienJ }}</option>
									@endif
								@endif
								@endforeach
							</select>
							@else
							<select id="txt_cliente" name="txt_cliente" class="form-control selectpicker" data-live-search="true">
								@foreach($clientes as $cliente)
								@if( $cliente->codiClienNatu != '001' )
									<option value="{{$cliente->codiClien}}">{{ $cliente->apePaterClienN }} {{ $cliente->apeMaterClienN }} {{ $cliente->nombreClienNatu }}</option>
								@else
									<option value="{{ $cliente->codiClien}}">{{ $cliente->razonSocialClienJ }}</option>
								@endif
								@endforeach
							</select>
							@endif
						</div>
					</div>
					<div class="col-md-2">
						<br>						
						<a href="#" class="btn btn-success add-modal" style="width: 100%;">Nuevo Cliente</a>
					</div>
				</div>
				<div class="row">
					<input type="hidden" name="txt_codiCoti" value="{{ $cotizacion }}">
					<input type="hidden" name="txt_codiCosteo" value="{{ $costeo }}">
					<input type="hidden" name="txt_codiCola" value="{{ Auth::user()->codiCola }}">
					<div class="col-md-10">
						Atencion:
						<div class="form-group">
							<select id="txt_atencion" name="txt_atencion" class="form-control selectpicker" data-live-search="true">
								@foreach($proveedoresContacto as $provContac)
									<option value="{{$provContac->codiProveeContac}}">{{ $provContac->apePaterProveeC }} {{ $provContac->apeMaterProveeC }} {{ $provContac->nombreProveeContac }}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="col-md-2">
						<br>						
						<a href="#" class="btn btn-success add-modal-contact" style="width: 100%;">Nuevo Contacto</a>
					</div>
					<div class="col-md-10">
						Asunto:
						@if(isset($coti_continue))
						<input type="text" id="txt_asuntoCoti" name="txt_asuntoCoti" class="form-control" value="{{ $coti_continue->asuntoCoti }}">
						@else
						<input type="text" id="txt_asuntoCoti" name="txt_asuntoCoti" class="form-control" value="{{ old('txt_asuntoCoti') }}">
						@endif
					</div>
					
				</div>
			</div>
		</div>
		
		<br>
		<div class="row">
			<div class="col-md-12">
				<div class="row">
					<div class="col-md-2">
						Dolar: <input type="text" disabled  name="txt_dolar" value="{{ $dolar->dolarVenta }}" class=" form-control" style="text-align: center;">
						<input type="hidden" name="txt_dolar" value="{{ $dolar->codiDolar }}">
					</div>
					<div class="col-md-2">
						IGV: <input type="text" disabled  name="txt_igv" value="{{ $igv->valorIgv/100 }}" class=" form-control" style="text-align: center;">
						<input type="hidden" name="txt_igv" value="{{ $igv->codiIgv }}">
					</div>
					<div class="col-md-6">
						
					</div>
					<div class="col-md-2">
						<br>
						<button id="btn_add_prod" type="button" class="btn btn-info pull-right" onclick="AgregarCampos()" style="width: 100%;">Agregar Producto</button>
					</div>
				</div><br>
				@if(isset($coti_continue))

					@if (count($costeosItems)>0)
						<label>PRODUCTOS</label>
						@foreach($costeosItems as $costeoItem)
						<div class="panel panel-primary panel-produc">
							<div class="panel-body">
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											Producto
											<input type="text" id="txt_producto" name="txt_producto" class="form-control" value="{{ $costeoItem->itemCosteo }}">
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											Descripción
											<textarea class="form-control" name="txt_descripion" placeholder="Detalles de producto">
												{{ $costeoItem->descCosteoItem }}
											</textarea>
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											Proveedor
											@if(isset($coti_continue))
												<select id="txt_proveedor" name="txt_proveedor" class="form-control selectpicker" data-live-search="true">
													@foreach($proveedores as $proveedor)
														@if($proveedor->codiClienNatu == $_cliente->codiClienNatu)
														<option value="{{$proveedor->codiProveedor}}" selected>{{ $proveedor->nombreProveedor }}</option>
														@else
														<option value="{{$proveedor->codiProveedor}}">{{ $proveedor->nombreProveedor }}</option>
														@endif
													@endforeach
												</select>
											@else
												<select id="txt_proveedor" name="txt_proveedor" class="form-control selectpicker" data-live-search="true">
													@foreach($proveedores as $proveedor)
														<option value="{{$proveedor->codiProveedor}}">{{ $proveedor->nombreProveedor }}</option>
													@endforeach
												</select>
											@endif
										</div>
									</div>									
								</div>
								<div class="row">
									<div class="col-md-1">
									</div>
									<div class="col-md-2">
										<div class="form-group">
											Cantidad
											<input type="number" id="txt_cantidad" name="txt_cantidad" class="form-control" value="{{ $costeoItem->cantiCoti }}">
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											C. U. $ SIN
											<input type="text" id="txt_cus_dolar_sin" name="txt_cus_dolar_sin" class="form-control" value="{{ $costeoItem->precioProducDolar }}">
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											C. U. $
											<input type="text" id="txt_cus_dolar" name="txt_cus_dolar" class="form-control" value="{{ $costeoItem->costoUniIgv }}">
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											TOTAL
											<input type="text" id="txt_total_dolar" name="txt_total_dolar" class="form-control" value="{{ $costeoItem->costoTotalIgv }}">
										</div>
									</div>
									<div class="col-md-2">
									</div>
									<div class="col-md-1">
									</div>
								</div>
								<div class="row">
									<div class="col-md-1">
									</div>
									<div class="col-md-2">
									</div>
									<div class="col-md-2">
										<div class="form-group">
											C. U. S/.
											<input type="text" id="txt_cus_soles" name="txt_cus_soles" class="form-control" value="{{ $costeoItem->costoUniSolesIgv }}">
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											MARGEN C.U. S/.
											<input type="text" id="txt_margen_cu_soles" name="txt_margen_cu_soles" class="form-control" value="{{ $costeoItem->margenCoti }}">
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											TOTAL
											<input type="text" id="txt_total_soles" name="txt_total_soles" class="form-control" value="{{ $costeoItem->costoTotalSolesIgv }}">
										</div>										
									</div>
									<div class="col-md-2">
										<div class="form-group">
											P. U. S/.
											<input type="text" id="txt_pu_soles" name="txt_pu_soles" class="form-control">
										</div>
									</div>
									<div class="col-md-1">
									</div>
								</div>								
							</div>
						</div>
						@endforeach
					@endif
				
				@else
				<div class="panel panel-primary panel-produc">
					<div class="panel-body">
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									Producto
									<input type="text" id="txt_producto" name="txt_producto" class="form-control" value="{{ old('txt_producto') }}">
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									Descripción
									<textarea class="form-control" name="txt_descripion" placeholder="Detalles de producto">
									</textarea>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									Proveedor
									<select id="txt_proveedor" name="txt_proveedor" class="form-control selectpicker" data-live-search="true">
										@foreach($proveedores as $proveedor)
											<option value="{{$proveedor->codiProveedor}}">{{ $proveedor->nombreProveedor }}</option>
										@endforeach
									</select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									Cantidad
									<input type="number" id="txt_cantidad" name="txt_cantidad" class="form-control" value="{{ old('txt_cantidad') }}">
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									C. U. $ SIN
									<input type="number" id="txt_cus_dolar_sin" name="txt_cus_dolar_sin" class="form-control" value="{{ old('txt_cus_dolar_sin') }}">
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									C. U. $
									<input type="number" id="txt_cus_dolar" name="txt_cus_dolar" class="form-control" value="{{ old('txt_cus_dolar') }}">
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									TOTAL
									<input type="number" id="txt_total_dolar" name="txt_total_dolar" class="form-control" value="{{ old('txt_total_dolar') }}">
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
									<input type="number" id="txt_cus_soles" name="txt_cus_soles" class="form-control" value="{{ old('txt_cus_soles') }}">
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									TOTAL
									<input type="number" id="txt_total_soles" name="txt_total_soles" class="form-control" value="{{ old('txt_total_soles') }}">
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
									<input type="text" id="txt_margen_cu_soles" name="txt_margen_cu_soles" class="form-control" value="{{ old('txt_margen_cu_soles') }}">
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									P. U. S/.
									<input type="number" id="txt_pu_soles" name="txt_pu_soles" class="form-control">
								</div>
							</div>
						</div>
					</div>
				</div>
				@endif
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
					@if(isset($coti_continue))
						<input type="text" name="txt_ventaTotal" class="form-control" value="{{ $cItem->costoTotalSolesIgv }}">
					@else
						<input type="text" name="txt_ventaTotal" class="form-control" value="{{ old('txt_ventaTotal') }}">
					@endif
				</div>
			</div>
			<div class="col-md-2">
				<div class="form-group">
					<label>UTILIDAD</label>
					@if(isset($coti_continue))
						<input type="text" name="txt_utilidadTotal" class="form-control" value="{{ $cItem->utiCoti }}">
					@else
						<input type="text" name="txt_utilidadTotal" class="form-control" value="{{ old('txt_utilidadTotal') }}">
					@endif
				</div>
			</div>
			<div class="col-md-2">
				<div class="form-group">
					<label>MARGEN</label>
					@if(isset($coti_continue))
						<input type="text" name="txt_margenTotal" class="form-control" value="{{ $cItem->margenVentaCoti }}">
					@else
						<input type="text" name="txt_margenTotal" class="form-control" value="{{ old('txt_margenTotal') }}">
					@endif
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
				@if(isset($coti_continue))
				<input type="hidden" name="txt_idCosteoItem" value="{{ $costeoItem->idCosteoItem }}">
				@endif
				<button class="btn btn-warning pull-right" type="submit" name="btn_pre" style="width: 100%;">GUARDAR PRE-COTIZACION</button>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-md-6">
				
			</div>
			<div class="col-md-2">
				<button class="btn btn-default pull-right" style="width: 100%;">CARTA DE PRESENTACION</button>
			</div>
			<div class="col-md-2">
				<button class="btn btn-default pull-right" style="width: 100%;">MODELO COTIZACION</button>
			</div>
			<div class="col-md-2">
				<button class="btn btn-success pull-right" type="submit" name="btn_coti" style="width: 100%;">FINALIZAR COTIZACION</button>
			</div>
		</div>

		{!!Form::close()!!}
		
	</div>	

	@include('cotizaciones.modalRegistros')

	<script>
		var editor_config = {
			selector:'textarea',
			height:200,
			theme: 'modern',
			menubar: true,
			plugins: ['print preview wordcount emoticons'],
			toolbar: "sizeselect | bold italic | fontselect |  fontsizeselect",
		}

		tinymce.init(editor_config);
	</script>
	
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
		
	</script>
@endsection