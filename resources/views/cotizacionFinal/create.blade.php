@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Configurar Estados de cotización</h3>
			@if(count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif

			{!!Form::open(array('url'=>'cotizacionEstados','method'=>'POST','autocomplete'=>'off'))!!}
			{{Form::token()}}
			<div class="form-group">
				<label for="">Estado</label>
				<input type="text" name="txt_nombreCotiEsta" required value="{{ old('txt_nombreCotiEsta') }}" class="form-control">
			</div>
			<div class="form-group">
				<label for="">Nombre breve</label>
				<input type="text" name="txt_nombreBreveCotiEsta" required value="{{ old('txt_nombreBreveCotiEsta') }}" class="form-control">
			</div>
			<div class="form-group">
				<label for="">Orden</label>
				<input type="number" name="txt_ordenCotiEsta" required value="{{ old('txt_ordenCotiEsta') }}" class="form-control">
			</div>

			<div class="form-group">
				<button class="btn btn-primary" type="submit">Guardar</button>
				<button class="btn btn-danger" type="reset">Cancelar</button>
			</div>

			{!!Form::close()!!}
		</div>
	</div>
@endsection