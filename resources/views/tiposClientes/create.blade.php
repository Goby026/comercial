@extends ('layouts.admin') @section ('contenido')
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<h3>Nuevo tipo de cliente</h3>
		@if(count($errors)>0)
		<div class="alert alert-danger">
			<ul>
				@foreach ($errors->all() as $error)
				<li>{{$error}}</li>
				@endforeach
			</ul>
		</div>
		@endif {!!Form::open(array('url'=>'tiposClientes','method'=>'POST','autocomplete'=>'off'))!!} {{Form::token()}}
		<div class="form-group">
			<label for="">Nombre</label>
			<input type="text" name="txtNombre" class="form-control" placeholder="Nombre...">
		</div>
		<div class="form-group">
			<label for="">Nombre Breve</label>
			<input type="text" name="txtNombreBreve" class="form-control" placeholder="Nombre breve...">
		</div>
		<div class="form-group">
			<label for="">Entidad</label>
			<input type="text" name="txtEntidad" class="form-control" placeholder="Tabla de base de datos">
			<small>La ENTIDAD hace referencia al modelo (Laravel) que registrará un nuevo cliente sea JURIDICO o NATURAL - este campo es
				de importancia ALTA</small>
		</div>
		<div class="form-group">
			<button class="btn btn-primary" type="submit">Guardar</button>
			<button class="btn btn-danger" type="reset">Cancelar</button>
		</div>

		{!!Form::close()!!}
	</div>
</div>
@endsection