@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Asignación de dolar por Proveedor</h3>
			@if(count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				</ul>
				@endforeach
			</div>
			@endif

			{!!Form::open(array('url'=>'dolarProveedor','method'=>'POST','autocomplete'=>'off'))!!}
			{{Form::token()}}
			<div class="form-group">
				<label for="">Proveedor</label>
				<input type="text" name="txt_nombreDolarProveedor" required value="{{ old('txt_nombreDolarProveedor') }}" class="form-control" placeholder="Proveedor...">
			</div>
			<div class="form-group">
				<label for="">Nombre breve</label>
				<input type="text" name="txt_nombreBreveDolarProveedor" required value="{{ old('txt_nombreBreveDolarProveedor') }}" class="form-control" placeholder="nombre breve...">
			</div>
			<div class="form-group">
				<label for="">Valor de dolar</label>
				<input type="text" name="txt_defectoDolarProveedor" required value="{{ old('txt_defectoDolarProveedor') }}" class="form-control" placeholder="valor...">
			</div>
			<div class="form-group">
				<button class="btn btn-primary" type="submit">Guardar</button>
				<button class="btn btn-danger" type="reset">Cancelar</button>
			</div>

			{!!Form::close()!!}
		</div>
	</div>
@endsection