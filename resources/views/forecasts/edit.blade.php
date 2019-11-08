@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar tipo de cambio: {{$dolar->dolarCompra}} - {{ $dolar->codiDolarProveedor }}</h3>
			@if(count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif
			
			{!!Form::model($dolar,['method'=>'PATCH','route'=>['dolar.update',$dolar->codiDolar]])!!}
			{{Form::token()}}
			<div class="form-group">
				<label for="">Compra</label>
				<input type="text" name="txt_dolarCompra"  value="{{ $dolar->dolarCompra }}" class="form-control">
			</div>
			<div class="form-group">
				<label for="">Venta</label>
				<input type="text" name="txt_dolarVenta"  value="{{ $dolar->dolarVenta }}" class="form-control">
			</div>
			<div class="form-group">
				<label for="">Fecha</label>
				<input type="date" name="txt_fechaCambio" value="{{ $dolar->fechaCambio }}" class="form-control">
			</div>
			<div class="form-group">
				<label for="">Proveedor</label>
				<select name="txt_codiDolarProveedor" class="form-control">
					@foreach($proveedores as $prov)
						@if($prov->codiDolarProveedor == $dolar->codiDolarProveedor)
						<option value="{{$prov->codiDolarProveedor}}" selected>{{$prov->nombreDolarProveedor}}</option>
						@else
						<option value="{{$prov->codiDolarProveedor}}">{{ $prov->nombreDolarProveedor }}</option>
						@endif
					@endforeach
				</select>
			</div>
			<div class="form-group">
				<label for="">Colaborador</label>
				<select name="txt_codiCola" class="form-control">
					@foreach($colaboradores as $colaborador)
						@if($colaborador->codiCola == $dolar->codiCola)
						<option value="{{$colaborador->codiCola}}" selected>{{$colaborador->nombreCola}}</option>
						@else
						<option value="{{$colaborador->codiCola}}">{{ $colaborador->nombreCola }}</option>
						@endif
					@endforeach
				</select>
			</div>

			<div class="form-group">
				<button class="btn btn-primary" type="submit">Modificar</button>
				<button class="btn btn-danger" type="reset">Cancelar</button>
			</div>

			{!!Form::close()!!}
		</div>
	</div>
@endsection