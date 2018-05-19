@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar precio</h3>
			@if(count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif
			
			{!!Form::model($precio,['method'=>'PATCH','route'=>['precioProductoProveedor.update',$precio->idTPrecioProductoProveedor]])!!}
			{{Form::token()}}
			<input type="hidden" name="txt_codiCola" value="{{ $precio->codiCola }}">
			<div class="form-group">
				<label for="">Producto</label>
				<select name="txt_codiProducProveedor" class="form-control">
					@foreach($productos as $producto)
						@if ($producto->codiProducProveedor==$precio->codiProducProveedor)
						<option value="{{ $producto->codiProducProveedor }}" selected>{{ $producto->nombreProducProveedor }}</option>
						@else
						<option value="{{ $producto->codiProducProveedor }}">{{ $producto->nombreProducProveedor }}</option>
						@endif
					@endforeach
				</select>
			</div>

			<div class="form-group">
				<label for="">Proveedor</label>
				<select name="txt_codiProveedor" class="form-control">
					@foreach($proveedores as $proveedor)
						@if ($proveedor->codiProveedor==$precio->codiProveedor)
						<option value="{{ $proveedor->codiProveedor }}" selected>{{ $proveedor->nombreProveedor }}</option>
						@else
						<option value="{{ $proveedor->codiProveedor }}">{{ $proveedor->nombreProveedor }}</option>
						@endif
					@endforeach
				</select>
			</div>

			<div class="form-group">
				<label for="">Precio</label>
				<input type="text" name="txt_precioProducDolar" required class="form-control" value="{{ $precio->precioProducDolar }}">
			</div>
			<div class="form-group">
				<label for="">Stock</label>
				<input type="number" name="txt_stockProduc" required class="form-control" value="{{ $precio->stockProduc }}">
			</div>
			<div class="form-group">
				<label for="">Tiempo de entrega</label>
				<input type="time" name="txt_tiempoEntreProduc" required class="form-control" value="{{ $precio->tiempoEntreProduc }}">
			</div>

			<div class="form-group">
				<button class="btn btn-primary" type="submit">Guardar</button>
				<button class="btn btn-danger" type="reset">Cancelar</button>
			</div>
			{!!Form::close()!!}
		</div>
	</div>
@endsection