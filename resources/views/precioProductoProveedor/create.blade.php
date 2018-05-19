@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Configurar Precio de Producto</h3>
			@if(count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif

			{!!Form::open(array('url'=>'precioProductoProveedor','method'=>'POST','autocomplete'=>'off'))!!}
			{{Form::token()}}
			<input type="hidden" name="txt_codiCola" value="{{ Auth::user()->codiCola }}">			
			<div class="form-group">
				<label for="">Producto</label>
				<select class="form-control" name="txt_codiProducProveedor">
					@foreach($productos as $producto)
					<option value="{{ $producto->codiProducProveedor }}">{{ $producto->nombreProducProveedor }}</option>
					@endforeach
				</select>
			</div>
			<div class="form-group">
				<label for="">Proveedor</label>
				<select class="form-control" name="txt_codiProveedor">
					@foreach($proveedores as $proveedor)
					<option value="{{ $proveedor->codiProveedor }}">{{ $proveedor->nombreProveedor }}</option>
					@endforeach
				</select>
			</div>
			<div class="form-group">
				<label for="">Precio</label>
				<input type="text" name="txt_precioProducDolar" required value="{{ old('txt_precioProducDolar') }}" class="form-control">
			</div>
			<div class="form-group">
				<label for="">Stock</label>
				<input type="number" name="txt_stockProduc" required value="{{ old('txt_stockProduc') }}" class="form-control">
			</div>
			<div class="form-group">
				<label for="">Tiempo de entrega</label>
				<input type="time" name="txt_tiempoEntreProduc" required value="{{ old('txt_tiempoEntreProduc') }}" class="form-control">
			</div>

			<div class="form-group">
				<button class="btn btn-primary" type="submit">Guardar</button>
				<button class="btn btn-danger" type="reset">Cancelar</button>
			</div>

			{!!Form::close()!!}
		</div>
	</div>
@endsection