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
			{!!Form::model($coti_continue,['method'=>'PATCH','route'=>['cotizaciones.update',$coti_continue],'name'=>'frm_coti','files'=>'true'])!!}
		@else
			{!!Form::model($cotizacion,['method'=>'PATCH','route'=>['cotizaciones.update',$cotizacion],'name'=>'frm_coti','files'=>'true'])!!}
		@endif

		{{Form::token()}}

		<div class="row">
			<div class="col-md-12">
				<div class="row">
					<div class="col-md-2">
						<div class="form-group">
							<label class="control-label">Ruc / dni</label>
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-book"></i></span>
								@if(isset($coti_continue))
									@if($coti_continue->codiClien== 1)
										<input type="text" class="form-control" name="txt_cliente_ruc_dni"
											   id="txt_cliente_ruc_dni" value="{{ $_cliente->nomCli }}">
										<input type="hidden" name="txt_codiClien" id="txt_cliente_ruc_dni" value="1">
									@else
										@if($_cliente->codiClienNatu == 1)
											<input type="text" class="form-control" name="txt_cliente_ruc_dni"
												   id="txt_cliente_ruc_dni" value="{{ $_cliente->dniClienNatu }}">
											<input type="hidden" name="txt_codiClien" id="txt_codiClien"
												   value="{{ $coti_continue->codiClien }}">
										@elseif($_cliente->codiClienJuri == 1)
											<input type="text" class="form-control" name="txt_cliente_ruc_dni"
												   id="txt_cliente_ruc_dni" value="{{ $_cliente->rucClienJuri }}">
											<input type="hidden" name="txt_codiClien" id="txt_cliente_ruc_dni"
												   value="{{ $coti_continue->codiClien }}">
										@endif
									@endif
								@else
									<input type="text" class="form-control" name="txt_cliente_ruc_dni"
										   id="txt_cliente_ruc_dni">
									<input type="hidden" name="txt_codiClien" id="txt_cliente_ruc_dni" value="">
								@endif
								<span class="input-group-btn">
      <button class="btn btn-success" type="button" id="btn_buscar_dniRuc"><i class="fa fa-search"></i></button>
    </span>
							</div>
						</div>
					</div>
					<div class="col-md-8">
						<div class="form-group">
							<label class="control-label">Cliente</label>
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-user"></i></span>
								@if(isset($coti_continue))
									@if($coti_continue->codiClien== 1)
										<input type="text" class="form-control" name="txt_cliente" id="txt_cliente"
											   value="{{ $coti_continue->nomCli }}">
									@else
										@if(isset($_cliente->codiClienNatu))
											<input type="text" class="form-control" name="txt_cliente" id="txt_cliente"
												   value="{{ $_cliente->nombreClienNatu }}">
										@else
											<input type="text" class="form-control" name="txt_cliente" id="txt_cliente"
												   value="{{ $_cliente->razonSocialClienJ }}">
										@endif
									@endif

								@else
									<input type="text" class="form-control" name="txt_cliente" id="txt_cliente">
								@endif
								{{--<span class="input-group-btn">--}}
								{{--<a href="{{ url('/cotizaciones/buscarCliente')  }}" class="btn btn-success"><i--}}
								{{--class="fa fa-cog"></i></a></span>--}}
							</div>
						</div>
					</div>
					<div class="col-md-2">
						<br>
						&nbsp;
					</div>
				</div>
				<div class="row">
					<input type="hidden" name="txt_codiCoti" value="{{ $cotizacion }}">
					<input type="hidden" name="txt_codiCosteo" value="{{ $costeo->codiCosteo }}">
					<input type="hidden" name="txt_codiCola" value="{{ Auth::user()->codiCola }}">
					<div class="col-md-2">
						<div class="form-group">
							<label class="control-label">Ruc / dni</label>
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-book"></i></span>
								@if(isset($coti_continue))
									@if($contactoCliente->codiContacClien == 1)
										<input type="text" class="form-control" name="txt_atencion_ruc_dni"
											   id="txt_atencion_ruc_dni" value="">
									@else
										<input type="text" class="form-control" name="txt_atencion_ruc_dni"
											   id="txt_atencion_ruc_dni" value="{{ $contactoCliente->dniContacClien  }}">
									@endif
									<input type="hidden" name="txt_codiContacClien" value="{{ $contactoCliente->codiContacClien }}">
								@else
									<input type="text" class="form-control" name="txt_atencion_ruc_dni"
										   id="txt_atencion_ruc_dni" value="{{ old('txt_atencion_ruc_dni') }}">
									<input type="hidden" name="txt_codiContacClien" value="{{ old('txt_codiContacClien') }}">
								@endif
								<span class="input-group-btn">
									<a href="#" class="btn btn-success" id="btn_getContacto"><i
												class="fa fa-search"></i></a>
    </span>
							</div>
						</div>
					</div>
					<div class="col-md-8">
						<div class="form-group">
							<label class="control-label">Atención</label>
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-user"></i></span>
								@if(isset($coti_continue))
									@if($contactoCliente->codiContacClien == 1)
										<input type="text" class="form-control" name="txt_atencion" id="txt_atencion" value="">
									@else
										<input type="text" class="form-control" name="txt_atencion" id="txt_atencion" value="{{$contactoCliente->nombreContacClien}} {{$contactoCliente->apePaterContacC}} {{$contactoCliente->apeMaterContacC}}">
									@endif

								@else
									<input type="text" class="form-control" name="txt_atencion" id="txt_atencion" value="{{old('txt_atencion')}}">
								@endif
								{{--<span class="input-group-btn">--}}
									{{--<a href="{{ url('/cotizaciones/getContactos')  }}" class="btn btn-success"><i--}}
												{{--class="fa fa-cog"></i></a></span>--}}
							</div>
						</div>
					</div>
					<div class="col-md-2">
						<br>
						&nbsp;
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
						Dolar: <input type="text" id="txt_dolar" name="txt_dolar" value="{{ $dolar->dolarVenta }}" class=" form-control" style="text-align: center;">
						<input type="hidden" name="txt_dolar" value="{{ $dolar->codiDolar }}">
					</div>
					<div class="col-md-2">
						IGV: <input type="text" id="txt_igv" name="txt_igv" value="{{ $igv->valorIgv/100 }}" class=" form-control" style="text-align: center;">
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
											<label for="">Descripción</label>
											<textarea id="txt_descripcion" class="form-control txt_descripcion" name="txt_descripcion{{ $costeoItem->numPack }}" placeholder="Detalles de producto">
												{{ $costeoItem->descCosteoItem }}
											</textarea>
										</div>
									</div>
									<div class="col-md-4">
										<center><label for="">Imagen</label></center>
										<div class="form-group">
											<textarea name="txt_imagen{{ $costeoItem->numPack }}" id="txt_imagen" class="form-control txt_imagen">{!! $costeoItem->imagen !!}

											</textarea>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-8">
										<div class="panel panel-danger">
											<div class="panel-heading">
												<h3 class="panel-title">Costeo Perú Data</h3>
											</div>
											<div class="panel-body">
												<table>
													<thead>
													<th>MARGEN C.U. S/.</th>
													<th>Cantidad</th>
													<th>C. U. $ SIN</th>
													<th>C. U. $</th>
													<th>TOTAL $</th>
													<th>C. U. S/.</th>
													<th>TOTAL S/.</th>
													<th>P. U. S/.</th>
													</thead>
													<tbody>
													<td>
														<input type="text"
															   id="txt_margen_cu_soles{{ $costeoItem->numPack }}"
															   class="form-control"
															   name="txt_margen_cu_soles{{ $costeoItem->numPack }}"
															   style="width: 100%; text-align: center;"
															   value="{{ $costeoItem->margenCoti }}"></td>
													<td>
														<input type="text" id="txt_cantidad{{ $costeoItem->numPack }}"
															   class="form-control"
															   name="txt_cantidad{{ $costeoItem->numPack }}"
															   style="width: 100%; text-align: center;"
															   value="{{ $costeoItem->cantiCoti }}"></td>
													<td>
														<input type="text"
															   id="txt_cus_dolar_sin{{ $costeoItem->numPack }}"
															   class="form-control"
															   name="txt_cus_dolar_sin{{ $costeoItem->numPack }}"
															   style="width: 100%; text-align: center;"
															   value="{{ $costeoItem->precioProducDolar }}"></td>
													<td>
														<input type="text" id="txt_cus_dolar{{ $costeoItem->numPack }}"
															   class="form-control"
															   name="txt_cus_dolar{{ $costeoItem->numPack }}"
															   style="width: 100%; text-align: center;"
															   value="{{ $costeoItem->costoUniIgv }}"></td>
													<td>
														<input type="text"
															   id="txt_total_dolar{{ $costeoItem->numPack }}"
															   class="form-control"
															   name="txt_total_dolar{{ $costeoItem->numPack }}"
															   style="width: 100%; text-align: center;"
															   value="{{ $costeoItem->costoTotalIgv }}"></td>
													<td>
														<input type="text" id="txt_cus_soles{{ $costeoItem->numPack }}"
															   class="form-control"
															   name="txt_cus_soles{{ $costeoItem->numPack }}"
															   style="width: 100%; text-align: center;"
															   value="{{ $costeoItem->costoUniSolesIgv }}"></td>
													<td>
														<input type="text"
															   id="txt_total_soles{{ $costeoItem->numPack }}"
															   class="form-control"
															   name="txt_total_soles{{ $costeoItem->numPack }}"
															   style="width: 100%; text-align: center;"
															   value="{{ $costeoItem->costoTotalSolesIgv }}"></td>
													<td>
														<input type="text" id="txt_pu_soles{{ $costeoItem->numPack }}"
															   class="form-control"
															   name="txt_pu_soles{{ $costeoItem->numPack }}"
															   style="width: 100%; text-align: center;"
															   value="">
													</td>
													</tbody>
												</table>

											</div>
										</div>
									</div>

									<div class="col-md-4">
										<div class="panel panel-info">
											<div class="panel-heading">
												<h3 class="panel-title">Precio cliente</h3>
											</div>
											<div class="panel-body">
												<div class="col-md-12">
													<table>
														<thead>
														<th>TOTAL</th>
														<th>UTILIDAD</th>
														<th>MARGEN</th>
														</thead>
														<tbody>
														<td>
															<input type="text"
																   id="txt_pu_total_soles{{ $costeoItem->numPack }}"
																   class="form-control"
																   name="txt_pu_total_soles{{ $costeoItem->numPack }}"
																   style="width: 100%; text-align: center;"
																   value="{{ $costeoItem->margenCoti * $costeoItem->costoTotalSolesIgv }}">
														</td>
														<td>
															<input type="text"
																   id="txt_utilidad_u{{ $costeoItem->numPack }}"
																   class="form-control"
																   name="txt_utilidad_u{{ $costeoItem->numPack }}"
																   style="width: 100%; text-align: center;"
																   value="{{ ($costeoItem->margenCoti * $costeoItem->costoTotalSolesIgv) - $costeoItem->costoTotalSolesIgv }}">
														</td>
														<td>
															<input type="text"
																   id="txt_margen_u{{ $costeoItem->numPack }}"
																   class="form-control"
																   name="txt_margen_u{{ $costeoItem->numPack }}"
																   style="width: 100%; text-align: center;"
																   value="{{ $costeoItem->margenVentaCoti  }}"></td>
														</tbody>
													</table>
												</div>
											</div>
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
										<select id="txt_producto1" name="txt_producto1"
												class="form-control selectpicker" data-live-search="true">
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
									<input type="text" name="txt_new_product1" class="form-control"
										   value="{{ old('txt_new_product1') }}">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									Proveedor
									<select id="txt_proveedor1" name="txt_proveedor1" class="form-control selectpicker"
											data-live-search="true">
										@foreach($proveedores as $proveedor)
											<option value="{{$proveedor->codiProveedor}}">{{ $proveedor->nombreProveedor }}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									Cod. Interno
									<input type="text" name="txt_cod_interno1" class="form-control"
										   value="{{ old('txt_cod_interno1') }}">
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									Cod. Proveedor
									<input type="text" name="txt_cod_proveedor1" class="form-control"
										   value="{{ old('txt_cod_proveedor1') }}">
								</div>
							</div>
							<div class="col-md-8">
								<div class="form-group">
									Descripción
									<textarea id="txt_descripcion1" class="form-control txt_descripcion" name="txt_descripcion1"
											  placeholder="Detalles de producto">
									</textarea>
								</div>
							</div>
							<div class="col-md-4">
								<center><label for="">Imagen</label></center>
								<div class="form-group">
											<textarea name="txt_imagen1" id="txt_imagen"
													  class="form-control txt_imagen">

											</textarea>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-8">
								<div class="panel panel-danger">
									<div class="panel-heading">
										<h3 class="panel-title">Costeo Perú Data</h3>
									</div>
									<div class="panel-body">
										<table>
											<thead>
											<th>MARGEN C.U. S/.</th>
											<th>Cantidad</th>
											<th>C. U. $ SIN</th>
											<th>C. U. $</th>
											<th>TOTAL $</th>
											<th>C. U. S/.</th>
											<th>TOTAL S/.</th>
											<th>P. U. S/.</th>
											</thead>
											<tbody>
											<td><input type="text" id="txt_margen_cu_soles1" name="txt_margen_cu_soles1"
													   class="form-control" value="{{ old('txt_margen_cu_soles1') }}">
											</td>
											<td><input type="text" id="txt_cantidad1" name="txt_cantidad1"
													   class="form-control" value="{{ old('txt_cantidad1') }}"></td>
											<td><input type="text" id="txt_cus_dolar_sin1" name="txt_cus_dolar_sin1"
													   class="form-control" value="{{ old('txt_cus_dolar_sin1') }}">
											</td>
											<td><input type="text" id="txt_cus_dolar1" name="txt_cus_dolar1"
													   class="form-control" value="{{ old('txt_cus_dolar1') }}"></td>
											<td><input type="text" id="txt_total_dolar1" name="txt_total_dolar1"
													   class="form-control" value="{{ old('txt_total_dolar1') }}"></td>
											<td><input type="text" id="txt_cus_soles1" name="txt_cus_soles1"
													   class="form-control" value="{{ old('txt_cus_soles1') }}"></td>
											<td><input type="text" id="txt_total_soles1" name="txt_total_soles1"
													   class="form-control" value="{{ old('txt_total_soles1') }}"></td>
											<td><input type="text" id="txt_pu_soles1" name="txt_pu_soles1"
													   class="form-control" value="{{ old('txt_pu_soles1') }}"></td>
											</tbody>
										</table>

									</div>
								</div>
							</div>

							<div class="col-md-4">
								<div class="panel panel-info">
									<div class="panel-heading">
										<h3 class="panel-title">Precio cliente</h3>
									</div>
									<div class="panel-body">
										<div class="col-md-12">
											<table>
												<thead>
												<th>TOTAL</th>
												<th>UTILIDAD</th>
												<th>MARGEN</th>
												</thead>
												<tbody>
												<td><input type="text" id="txt_pu_total_soles1"
														   name="txt_pu_total_soles1" class="form-control"
														   value="{{ old('txt_pu_total_soles1') }}"></td>
												<td><input type="text" id="txt_utilidad_u1" name="txt_utilidad_u1"
														   class="form-control" value="{{ old('txt_utilidad_u1') }}">
												</td>
												<td><input type="text" id="txt_margen_u1" name="txt_margen_u1"
														   class="form-control" value="{{ old('txt_margen_u1') }}"></td>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				@endif
				<div class="row">
					<div class="col-md-6">
						<div class="panel panel-danger">
							<div class="panel-heading">
								<a href="#" class="pull-right"><i class="fa fa-cog"></i> Editar</a>
								<h3 class="panel-title">CONDICIONES COMERCIALES </h3>
							</div>
							<div class="panel-body">
								@foreach($condicionesCom as $condicion)
									<p>{{ $condicion->descripCondiComer }}</p>
								@endforeach
							</div>
						</div>
					</div>
					<div class="col-md-2">
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

				<div id="campos"></div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-3">
			</div>
			<div class="col-md-2">
				<div class="form-group">
					<label for="cb_ver_total">MOSTRAR TOTAL</label>&nbsp;&nbsp;&nbsp;
					@if(isset($coti_continue))
						<input type="checkbox" name="cb_ver_total" id="cb_ver_total" checked value="1">
						<input type="text" id="txt_ventaTotal" name="txt_ventaTotal" class="form-control" value="{{ $cItem->costoTotalSolesIgv }}">
					@else
						<input type="checkbox" name="cb_ver_total" id="cb_ver_total" value="1">
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
						<input type="text" id="txt_margenTotal" name="txt_margenTotal" class="form-control" value="{{ $cItem->margenVentaCoti }}">
					@else
						<input type="text" id="txt_margenTotal" name="txt_margenTotal" class="form-control" value="{{ old('txt_margenTotal') }}">
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
    $(document).ready(function() {
        $("frm_coti").keypress(function(e) {
            if (e.which == 13) {
                return false;
            }
        });
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
</script>

<script>
    var numCoti = parseInt($("#txt_total_costeos").val());
    var cambio = $("#txt_dolar").val();
    var igv = $("#txt_igv").val();
    var total = 0.0;
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
                    var pus = (margenCuSoles * totalSoles)/cantidad;

                    $(txt_pu_soles).val(parseFloat(pus).toFixed(2));

                    var ventaTotal = pus * cantidad;
                    var uti = ventaTotal - totalSoles;
                    var margen = (uti * 100) / ventaTotal;

                    $(txt_pu_total_soles).val(parseFloat(ventaTotal).toFixed(2));

                    $(txt_utilidad_u).val(parseFloat(uti).toFixed(2));

                    $(txt_margen_u).val(parseFloat(margen).toFixed(2));

//                    total += ventaTotal;
//                    utilidad += uti;
//
//                    $('#txt_ventaTotal').val(parseFloat(total).toFixed(2));
//                    $('#txt_utilidadTotal').val(parseFloat(utilidad).toFixed(2));

                    console.log(pus);
					calcSumas();
                });
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

</script>

<script>
    var numCoti = parseInt($("#txt_total_costeos").val());
//    var cambio = $("#txt_dolar").val();
//    var igv = $("#txt_igv").val();
//    var total = 0;
//    var utilidad = 0;

    $('input').click(function () {

        for (var i = 1; i < numCoti + 1; i++) {

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

                $(txt_pu_soles).keyup(function () {
                    // console.log($(this).attr('name'));
                    var cantidad = parseFloat($(txt_cantidad).val());
                    var precioSinIgv = $(txt_cus_dolar_sin).val();
                    var margenCuSoles = $(txt_margen_cu_soles).val();//1.35

					var totalPuSoles = $(txt_pu_soles).val();
                    var utilidad = 0.0;
                    var margen = 0.0;

                    if(cantidad > 0.0){
                        if(parseFloat(margenCuSoles) > 0){
                            if (parseFloat(precioSinIgv) > 0){
                                $(txt_pu_total_soles).val(totalPuSoles * cantidad);
                                utilidad = parseFloat($(txt_pu_total_soles).val()) - parseFloat($(txt_total_soles).val());
                                margen = (utilidad * 100)/ parseFloat($(txt_pu_total_soles).val());
                                $(txt_utilidad_u).val(utilidad.toFixed(2));
                                $(txt_margen_u).val(margen.toFixed(2));
							}else{
                                console.log("Ingrese precio en dolares!!");
							}
						}else{
                            console.log("Ingrese margen de costo unitario!!");
						}
                    }else{
                        console.log("Ingrese cantidad!!");
					}

                });
            }
        }

    });

</script>

@endsection