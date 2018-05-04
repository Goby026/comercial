@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Nuevo Cargo de Contactos</h3>
			@if(count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				</ul>
				@endforeach
			</div>
			@endif

			{!!Form::open(array('url'=>'cargoContactos','method'=>'POST','autocomplete'=>'off'))!!}
			{{Form::token()}}
			<div class="form-group">
				<label for="">Nombre</label>
				<input type="text" name="txt_nombreCargoContac" required value="{{ old('txt_nombreCargoContac') }}" class="form-control">
			</div>
			<div class="form-group">
				<label for="">Nombre Breve</label>
				<input type="text" name="txt_nombreBreveCargoContac" required value="{{ old('txt_nombreBreveCargoContac') }}" class="form-control">
			</div>			
			<div class="form-group">
				<button class="btn btn-primary" type="submit">Guardar</button>
				<button class="btn btn-danger" type="reset">Cancelar</button>
			</div>

			{!!Form::close()!!}
		</div>
	</div>
@endsection