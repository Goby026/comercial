@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Nuevo Proveedor</h3>
			@if(count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif

			{!!Form::open(array('url'=>'proveedores','method'=>'POST','autocomplete'=>'off'))!!}
			{{Form::token()}}
			<div class="form-group">
				<label for="">Nombre</label>
				<input type="text" name="txt_nombreProveedor" required value="{{ old('txt_nombreProveedor') }}" class="form-control">
			</div>
			<div class="form-group">
				<label for="">Nombre Breve</label>
				<input type="text" name="txt_nombreBreveProveedor" required value="{{ old('txt_nombreBreveProveedor') }}" class="form-control">
			</div>
			<div class="form-group">
				<label for="">Ruc</label>
				<input type="text" name="txt_RucProveedor" required value="{{ old('txt_RucProveedor') }}" class="form-control">
			</div>
			<div class="form-group">
				<label for="">Dirección</label>
				<input type="text" name="txt_direcProveedor" required value="{{ old('txt_direcProveedor') }}" class="form-control">
			</div>
			<div class="form-group">
				<label for="">Web</label>
				<input type="text" name="txt_webProveedor" required value="{{ old('txt_webProveedor') }}" class="form-control">
			</div>
			<div class="form-group">
				<label for="">Distrito</label>
				<input type="text" name="txt_codiDistri" required value="{{ old('txt_codiDistri') }}" class="form-control">
			</div>
			<div class="form-group">
				<label for="">Provincia</label>
				<input type="text" name="txt_codiProvin" required value="{{ old('txt_codiProvin') }}" class="form-control">
			</div>
			<div class="form-group">
				<label for="">Departamento</label>
				<input type="text" name="txt_codiDepar" required value="{{ old('txt_codiDepar') }}" class="form-control">
			</div>
			<div class="form-group">
				<button class="btn btn-primary" type="submit">Guardar</button>
				<button class="btn btn-danger" type="reset">Cancelar</button>
			</div>

			{!!Form::close()!!}
		</div>
	</div>
@endsection