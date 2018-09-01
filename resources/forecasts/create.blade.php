@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Configuración de tipo de cambio</h3>
			@if(count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif

			{!!Form::open(array('url'=>'dolar','method'=>'POST','autocomplete'=>'off'))!!}
			{{Form::token()}}
			<div class="form-group">
				<label for="">Compra</label>
				<input type="text" name="txt_dolarCompra" required value="{{ old('txt_dolarCompra') }}" class="form-control" placeholder="compra...">
			</div>
			<div class="form-group">
				<label for="">Venta</label>
				<input type="text" name="txt_dolarVenta" required value="{{ old('txt_dolarVenta') }}" class="form-control" placeholder="venta...">
			</div>
			<div class="form-group">
				<label for="">Fecha</label>
				<input type="date" name="txt_fechaCambio" class="form-control">
			</div>
			<div class="form-group">
				<label for="">Proveedor</label>
				<select name="txt_codiDolarProveedor" class="form-control">
					@foreach($dolarProveedor as $dolarProv)
						<option value="{{$dolarProv->codiDolarProveedor}}">{{$dolarProv->nombreDolarProveedor}}</option>
					@endforeach
				</select>
			</div>

			<div class="form-group">
				<label for="">Colaborador</label>
				<input type="text" name="txt_codiCola" required value="{{ old('txt_codiCola') }}" class="form-control" placeholder="valor...">
			</div>
			
			<div class="form-group">
				<button class="btn btn-primary" type="submit">Guardar</button>
				<button class="btn btn-danger" type="reset">Cancelar</button>
			</div>

			{!!Form::close()!!}
		</div>
	</div>
@endsection