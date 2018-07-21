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
				<center>Código Cotización</center>
				@if(isset($coti_continue))
				<input type="text" disabled name="txtNumCoti" class="form-control" value="{{ $coti_continue->numCoti }}" style="text-align: center;">
				@else
				<input type="text" disabled name="txtNumCoti" class="form-control" value="{{ $dataCotizacion->numCoti}}" style="text-align: center;">
				@endif
			</div>
		</div>

		<style type="text/css">
			.panel-produc{
				background-color: #FDCDCD;
			}

			.img-produc{
				max-height: 354px;
				width:100%;
			}

		</style>

		@if(isset($coti_continue))
			{!!Form::model($coti_continue,['method'=>'PATCH','route'=>['cotizaciones.update',$coti_continue],'files'=>'true'])!!}
		@else
			{!!Form::model($cotizacion,['method'=>'PATCH','route'=>['cotizaciones.update',$cotizacion],'files'=>'true'])!!}
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
					<input type="hidden" name="txt_codiCosteo" value="{{ $costeo->codiCosteo }}">
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
						Dolar: <input type="text" disabled id="txt_dolar" name="txt_dolar" value="{{ $dolar->dolarVenta }}" class=" form-control" style="text-align: center;">
						<input type="hidden" name="txt_dolar" value="{{ $dolar->codiDolar }}">
					</div>
					<div class="col-md-2">
						IGV: <input type="text" disabled id="txt_igv" name="txt_igv" value="{{ $igv->valorIgv/100 }}" class=" form-control" style="text-align: center;">
						<input type="hidden" name="txt_igv" value="{{ $igv->codiIgv }}">
					</div>
					<div class="col-md-2">
					</div>
					<div class="col-md-4 radios">
						<br>
						@if($costeo->tipoCosteo == 0)
							<label for="cb_producto" style="cursor: pointer; font-size: 16px;">Producto</label>
							<input type="radio" name="cb_option" id="cb_producto" checked value="0">&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;
							<label for="cb_servicio" style="cursor: pointer; font-size: 16px;">Servicio</label>
							<input type="radio" name="cb_option" id="cb_servicio" value="1">
						@elseif($costeo->tipoCosteo == 1)
							<label for="cb_producto" style="cursor: pointer; font-size: 16px;">Producto</label>
							<input type="radio" name="cb_option" id="cb_producto" value="0">&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;
							<label for="cb_servicio" style="cursor: pointer; font-size: 16px;">Servicio</label>
							<input type="radio" name="cb_option" id="cb_servicio" checked value="1">
						@else{
						<label for="cb_producto" style="cursor: pointer; font-size: 16px;">Producto</label>
						<input type="radio" name="cb_option" id="cb_producto" value="0">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;
						<label for="cb_servicio" style="cursor: pointer; font-size: 16px;">Servicio</label>
						<input type="radio" name="cb_option" id="cb_servicio" value="1">
						}
						@endif
					</div>
					<div class="col-md-2">
						<br>
						<a href="#" class="btn btn-primary pull-right add-modal-newItem" style="width: 100%;">Agregar Producto</a>
					</div>
				</div><br>
				@if(isset($coti_continue))

					@if (count($costeosItems)>0)
						<label>PRODUCTOS</label>
						<span class="pull-right">TOTAL COSTEOS <input type="text" id="txt_total_costeos" name="txt_total_costeos" value="{{ count($costeosItems) }}" size="5" style="text-align: center;"></span>
						@foreach($costeosItems as $costeoItem)
						<div class="panel panel-primary panel-produc">
							<div class="panel-body">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											Producto
											<div id="txt_prod_select">
												<select id="txt_producto{{ $costeoItem->numPack }}"
														name="txt_producto{{ $costeoItem->numPack }}"
														class="form-control selectpicker" data-live-search="true">
													<option value="1">Seleccionar Producto</option>
													@foreach ($productos as $producto)

														@if($producto->idTPrecioProductoProveedor == $costeoItem->idTPrecioProductoProveedor)
															<option value="{{ $producto->idTPrecioProductoProveedor }}"
																	selected>{{ $producto->nombreProducProveedor }}</option>
														@else
															<option value="{{ $producto->idTPrecioProductoProveedor }}">{{ $producto->nombreProducProveedor }}</option>
														@endif
													@endforeach
												</select>
											</div>
											{{-- <input type="text" id="txt_producto" name="txt_producto" class="form-control" value="{{ $costeoItem->itemCosteo }}"> --}}
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											Nuevo Producto
											@if($costeoItem->itemCosteo == ".")
												<input type="text" name="txt_new_product{{ $costeoItem->numPack }}"
													   class="form-control" value="">
											@else
												<input type="text" name="txt_new_product{{ $costeoItem->numPack }}"
													   class="form-control" value="{{ $costeoItem->itemCosteo }}">
											@endif
										</div>
									</div>
									<div class="col-md-6">
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
									<div class="col-md-3">
										<div class="form-group">
											Cod. Interno
											<input type="text" name="txt_cod_interno{{ $costeoItem->numPack }}" class="form-control" value="{{ $costeoItem->codInterno }}">
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											Cod. Proveedor
											<input type="text" name="txt_cod_proveedor{{ $costeoItem->numPack }}" class="form-control" value="{{ $costeoItem->codProveedor }}">
										</div>
									</div>
									<div class="col-md-8">
										<div class="form-group">
											Descripción
											<textarea class="form-control" name="txt_descripcion{{ $costeoItem->numPack }}" placeholder="Detalles de producto">
												{{ $costeoItem->descCosteoItem }}
											</textarea>
										</div>
									</div>
									<div class="col-md-4">
										<center><label for="">Imagen</label></center>
										<div class="form-group">
											<input type="file" id="txt_imagen{{ $costeoItem->numPack }}"
												   name="txt_imagen{{ $costeoItem->numPack }}" value="1245"/>
											<br/>
											@if(($costeoItem->imagen)!= "")
												<img src="{{ asset('imagenes/productos/'.$costeoItem->imagen) }}"
													 alt="{{ $costeoItem->imagen }}" class="img-produc">
											@endif

										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-1">
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<label for="" style="font-size: 10px;">MARGEN C.U. S/.</label>
											<input type="text" id="txt_margen_cu_soles{{ $costeoItem->numPack }}" name="txt_margen_cu_soles{{ $costeoItem->numPack }}" style="width: 100%; text-align: center;" value="{{ $costeoItem->margenCoti }}">
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<label for="" style="font-size: 10px;">Cantidad</label>
											<input type="text" id="txt_cantidad{{ $costeoItem->numPack }}" name="txt_cantidad{{ $costeoItem->numPack }}" style="width: 100%; text-align: center;" value="{{ $costeoItem->cantiCoti }}">
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<label for="" style="font-size: 10px;">C. U. $ SIN</label>
											<input type="text" id="txt_cus_dolar_sin{{ $costeoItem->numPack }}" name="txt_cus_dolar_sin{{ $costeoItem->numPack }}" style="width: 100%; text-align: center;" value="{{ $costeoItem->precioProducDolar }}">
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<label for="" style="font-size: 10px;">C. U. $</label>
											<input type="text" id="txt_cus_dolar{{ $costeoItem->numPack }}" name="txt_cus_dolar{{ $costeoItem->numPack }}" style="width: 100%; text-align: center;" value="{{ $costeoItem->costoUniIgv }}">
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<label for="" style="font-size: 10px;">TOTAL $</label>
											<input type="text" id="txt_total_dolar{{ $costeoItem->numPack }}" name="txt_total_dolar{{ $costeoItem->numPack }}" style="width: 100%; text-align: center;" value="{{ $costeoItem->costoTotalIgv }}">
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<label for="" style="font-size: 10px;">C. U. S/.</label>
											<input type="text" id="txt_cus_soles{{ $costeoItem->numPack }}" name="txt_cus_soles{{ $costeoItem->numPack }}" style="width: 100%; text-align: center;" value="{{ $costeoItem->costoUniSolesIgv }}">
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<label for="" style="font-size: 10px;">TOTAL S/.</label>
											<input type="text" id="txt_total_soles{{ $costeoItem->numPack }}" name="txt_total_soles{{ $costeoItem->numPack }}" style="width: 100%; text-align: center;" value="{{ $costeoItem->costoTotalSolesIgv }}">
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<label for="" style="font-size: 10px;">P. U. S/.</label>
											<input type="text" id="txt_pu_soles{{ $costeoItem->numPack }}" name="txt_pu_soles{{ $costeoItem->numPack }}" style="width: 100%; text-align: center;" value="{{ $costeoItem->margenCoti * $costeoItem->costoTotalSolesIgv }}">
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<label for="" style="font-size: 10px;">TOTAL</label>
											<input type="text" id="txt_pu_total_soles{{ $costeoItem->numPack }}" name="txt_pu_total_soles{{ $costeoItem->numPack }}" style="width: 100%; text-align: center;" value="{{ $costeoItem->margenCoti * $costeoItem->costoTotalSolesIgv }}">
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<label for="" style="font-size: 10px;">UTILIDAD</label>
											<input type="text" id="txt_utilidad_u{{ $costeoItem->numPack }}" name="txt_utilidad_u{{ $costeoItem->numPack }}" style="width: 100%; text-align: center;" value="{{ ($costeoItem->margenCoti * $costeoItem->costoTotalSolesIgv) - $costeoItem->costoTotalSolesIgv }}">
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<label for="" style="font-size: 10px;">MARGEN</label>
											<input type="text" id="txt_margen_u{{ $costeoItem->numPack }}" name="txt_margen_u{{ $costeoItem->numPack }}" style="width: 100%; text-align: center;" value="{{ $costeoItem->margenVentaCoti  }}">
										</div>
									</div>
								</div>
							</div>
						</div>
						@endforeach
					@endif
				@else

				<label>PRODUCTOS</label>
				<span class="pull-right">TOTAL COSTEOS <input type="text" id="txt_total_costeos" name="txt_total_costeos" value="1" size="5" style="text-align: center;"></span>
				<div class="panel panel-primary panel-produc">
					<div class="panel-body">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									Producto
									<div id="txt_prod_select">
										<select id="txt_producto1" name="txt_producto1" class="form-control selectpicker" data-live-search="true">
											<option value="1">Seleccionar Producto</option>
											@foreach ($productos as $producto)
												<option value="{{ $producto->codiProducProveedor }}">{{ $producto->nombreProducProveedor }}</option>
											@endforeach
										</select>
									</div>
									{{-- <input type="text" id="txt_producto" name="txt_producto" class="form-control" value="{{ $costeoItem->itemCosteo }}"> --}}
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									Nuevo
									<input type="text" name="txt_new_product1" class="form-control" value="{{ old('txt_new_product1') }}">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									Proveedor
									<select id="txt_proveedor1" name="txt_proveedor1" class="form-control selectpicker" data-live-search="true">
										@foreach($proveedores as $proveedor)
										<option value="{{$proveedor->codiProveedor}}">{{ $proveedor->nombreProveedor }}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									Cod. Interno
									<input type="text" name="txt_cod_interno1" class="form-control" value="{{ old('txt_cod_interno1') }}">
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									Cod. Proveedor
									<input type="text" name="txt_cod_proveedor1" class="form-control" value="{{ old('txt_cod_proveedor1') }}">
								</div>
							</div>
							<div class="col-md-8">
								<div class="form-group">
									Descripción
									<textarea class="form-control" name="txt_descripcion1" placeholder="Detalles de producto">
									</textarea>
								</div>
							</div>
							<div class="col-md-4">
								<center><label for="files1">Imagen</label></center>
								<div class="form-group">
									<input type="file" id="files1" name="files1[]" />
									<br />
									<output id="list1"></output>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-1">
							</div>
							<div class="col-md-1">
								<div class="form-group">
									MARGEN C.U. S/.
									<input type="text" id="txt_margen_cu_soles1" name="txt_margen_cu_soles1" class="form-control" value="{{ old('txt_margen_cu_soles1') }}">
								</div>
							</div>
							<div class="col-md-1">
								<div class="form-group">
									Cantidad
									<input type="text" id="txt_cantidad1" name="txt_cantidad1" class="form-control" value="{{ old('txt_cantidad1') }}">
								</div>
							</div>
							<div class="col-md-1">
								<div class="form-group">
									C. U. $ SIN
									<input type="text" id="txt_cus_dolar_sin1" name="txt_cus_dolar_sin1" class="form-control" value="{{ old('txt_cus_dolar_sin1') }}">
								</div>
							</div>
							<div class="col-md-1">
								<div class="form-group">
									C. U. $
									<input type="text" id="txt_cus_dolar1" name="txt_cus_dolar1" class="form-control" value="{{ old('txt_cus_dolar1') }}">
								</div>
							</div>
							<div class="col-md-1">
								<div class="form-group">
									TOTAL $
									<input type="text" id="txt_total_dolar1" name="txt_total_dolar1" class="form-control" value="{{ old('txt_total_dolar1') }}">
								</div>
							</div>
							<div class="col-md-1">
								<div class="form-group">
									C. U. S/.
									<input type="text" id="txt_cus_soles1" name="txt_cus_soles1" class="form-control" value="{{ old('txt_cus_soles1') }}">
								</div>
							</div>
							<div class="col-md-1">
								<div class="form-group">
									TOTAL S/.
									<input type="text" id="txt_total_soles1" name="txt_total_soles1" class="form-control" value="{{ old('txt_total_soles1') }}">
								</div>
							</div>
							<div class="col-md-1">
								<div class="form-group">
									P. U. S/.
									<input type="text" id="txt_pu_soles1" name="txt_pu_soles1" class="form-control" value="{{ old('txt_pu_soles1') }}">
								</div>
							</div>
							<div class="col-md-1">
								<div class="form-group">
									TOTAL
									<input type="text" id="txt_pu_total_soles1" name="txt_pu_total_soles1" class="form-control" value="{{ old('txt_pu_total_soles1') }}">
								</div>
							</div>
							<div class="col-md-1">
								<div class="form-group">
									UTILIDAD
									<input type="text" id="txt_utilidad_u1" name="txt_utilidad_u1" class="form-control" value="{{ old('txt_utilidad_u1') }}">
								</div>
							</div>
							<div class="col-md-1">
								<div class="form-group">
									MARGEN
									<input type="text" id="txt_margen_u1" name="txt_margen_u1" class="form-control" value="{{ old('txt_margen_u1') }}">
								</div>
							</div>
						</div>
					</div>
				</div>
				@endif
				<div class="row">
					<label for="">CONDICIONES COMERCIALES</label>
					<div class="panel panel-success">
						<div class="panel-body">
							<div class="col-md-6">
								<div class="form-group">
									<textarea name="txt_condiciones_comerciales" id="" cols="30" rows="10">
										@foreach($condicionesCom as $condicion)
											<p>{{ $condicion->descripCondiComer }}</p>
										@endforeach
									</textarea>
								</div>
							</div><div class="col-md-6">
								<label for="">TIPO DE MONEDA</label>
								<select id="cmb_currency" name="cmb_currency" class="form-control">
									@if($costeo->currency == 0)
										<option value="0" selected>SOLES</option>
										<option value="1">DOLARES</option>
									@else
										<option value="0">SOLES</option>
										<option value="1" selected>DOLARES</option>
									@endif
								</select>
							</div>
						</div>
					</div>
				</div>

				<div id="campos"></div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-3">
			</div>
			<div class="col-md-2">
				<div class="form-group">
					<label for="cb_ver_total">MOSTRAR TOTAL</label>&nbsp;&nbsp;&nbsp;<input type="checkbox" name="cb_ver_total" id="cb_ver_total" value="1">
					@if(isset($coti_continue))
						<input type="text" id="txt_ventaTotal" name="txt_ventaTotal" class="form-control" value="{{ $cItem->costoTotalSolesIgv }}">
					@else
						<input type="text" id="txt_ventaTotal" name="txt_ventaTotal" class="form-control" value="{{ old('txt_ventaTotal') }}">
					@endif
				</div>
			</div>
			<div class="col-md-2">
				<div class="form-group">
					<label>UTILIDAD</label>
					@if(isset($coti_continue))
						<input type="text" id="txt_utilidadTotal" name="txt_utilidadTotal" class="form-control" value="{{ $cItem->utiCoti }}">
					@else
						<input type="text" id="txt_utilidadTotal" name="txt_utilidadTotal" class="form-control" value="{{ old('txt_utilidadTotal') }}">
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
				<button class="btn btn-warning pull-right" type="submit" name="btn_pre" style="width: 100%;">GUARDAR
					PRE-COTIZACION
				</button>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-md-4">
			</div>
			<div class="col-md-2">
				@if(isset($coti_continue))
					<a href="{{ url('cotizacion',['codiCoti'=>$coti_continue->codiCoti]) }}" class="btn btn-default pull-right" style="width: 100%;">VISTA TABLA</a>
				@else
					<a href="{{ url('cotizacion',$cotizacion) }}" class="btn btn-default pull-right" style="width: 100%;">VISTA TABLA</a>
				@endif
			</div>
			<div class="col-md-2">
				<a href="{{url('pdf')}}" class="btn btn-default pull-right" style="width: 100%;" target="_blank">CARTA DE PRESENTACION</a>
			</div>
			<div class="col-md-2">
				<a class="btn btn-default pull-right" style="width: 100%;" href="{{ url('pdfCoti', $cotizacion) }}" target="_blank">VISTA PREVIA</a>
			</div>
			<div class="col-md-2">
				<button class="btn btn-success pull-right" type="submit" name="btn_coti" style="width: 100%;">FINALIZAR COTIZACION</button>
			</div>
		</div>

		{!!Form::close()!!}
		
	</div>

	@include('cotizaciones.modalRegistros')

<script>
    var numCoti = parseInt($("#txt_total_costeos").val());
    var cambio = $("#txt_dolar").val();
    var igv = $("#txt_igv").val();
    var total = 0;
    var utilidad = 0;

    $('input').click(function () {

        for (var i = 1; i < numCoti + 1; i++) {

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

                $(txt_cantidad + ", " + txt_cus_dolar_sin + ", " + txt_margen_cu_soles).keyup(function () {
                    // console.log($(this).attr('name'));
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
                    var pus = margenCuSoles * totalSoles;

                    $(txt_pu_soles).val(parseFloat(pus).toFixed(2));

                    var ventaTotal = pus;
                    var uti = ventaTotal - totalSoles;
                    var margen = (uti * 100) / ventaTotal;

                    $(txt_pu_total_soles).val(parseFloat(ventaTotal).toFixed(2));

                    $(txt_utilidad_u).val(parseFloat(uti).toFixed(2));

                    $(txt_margen_u).val(parseFloat(margen).toFixed(2));

                    total += ventaTotal;
                    utilidad += uti;

                    $('#txt_ventaTotal').val(parseFloat(total).toFixed(2));
                    $('#txt_utilidadTotal').val(parseFloat(utilidad).toFixed(2));

                    // console.log(precioSinIgv);
                });
            }
        }

    });

</script>

<script>
    var editor_config = {
        path_absolute: "/",
        selector: "textarea",
		height : 300,
        plugins: [
            "advlist autolink lists link charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars code fullscreen",
            "insertdatetime media nonbreaking save table contextmenu directionality",
            "emoticons template paste textcolor colorpicker textpattern"
        ],
        toolbar: "insertfile undo redo | fontsizeselect | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link",
        fontsize_formats: "8pt 10pt 12pt 14pt 18pt 24pt 36pt",
        relative_urls: false,
        file_browser_callback: function (field_name, url, type, win) {
            var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
            var y = window.innerHeight || document.documentElement.clientHeight || document.getElementsByTagName('body')[0].clientHeight;

            var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
            if (type == 'image') {
                cmsURL = cmsURL + "&type=Images";
            } else {
                cmsURL = cmsURL + "&type=Files";
            }

            tinyMCE.activeEditor.windowManager.open({
                file: cmsURL,
                title: 'Filemanager',
                width: x * 0.8,
                height: y * 0.8,
                resizable: "yes",
                close_previous: "no"
            });
        }
    };

    tinymce.init(editor_config);
</script>
@endsection