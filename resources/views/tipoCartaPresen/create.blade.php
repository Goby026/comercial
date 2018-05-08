@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Configuración de tipo de Carta de Presentación</h3>
			@if(count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>				
				@endforeach
				</ul>
			</div>
			@endif

			{!!Form::open(array('url'=>'tipoCartaPresen','method'=>'POST','autocomplete'=>'off'))!!}
			{{Form::token()}}
			<div class="form-group">
				<label for="">Tipo de Carta</label>
				<input type="text" name="txt_tipoCartaPresen" required value="{{ old('txt_tipoCartaPresen') }}" class="form-control" placeholder="tipo...">
			</div>
			<div class="form-group">
				<label for="">Nombre</label>
				<input type="text" name="txt_nombreTipoCartaP" required value="{{ old('txt_nombreTipoCartaP') }}" class="form-control" placeholder="nombre...">
			</div>
			<div class="form-group">
				<label for="">Nombre Breve</label>
				<input type="text" name="txt_nombreBreveTipoCartaP" value="{{ old('txt_nombreBreveTipoCartaP') }}" class="form-control" placeholder="nombre breve...">
			</div>
			
			<div class="form-group">
				<button class="btn btn-primary" type="submit">Guardar</button>
				<button class="btn btn-danger" type="reset">Cancelar</button>
			</div>

			{!!Form::close()!!}
		</div>
	</div>
@endsection